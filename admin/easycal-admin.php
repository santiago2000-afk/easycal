<?php
class Easycal_Admin {

private $plugin_name;
private $version;

public function __construct($plugin_name, $version) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
}

public function easycal_init_post_type() {
    $labels = array(
        'name'               => __('EasyCal'),
        'singular_name'      => __('EasyCal'),
        'menu_name'          => __('EasyCal'),
        'all_items'          => __('Añadir Calendario'),
        'add_new'            => __('Agregar Nuevo'),
        'add_new_item'       => __('Agregar Nuevo Calendario'),
        'edit_item'          => __('Editar Calendario'),
        'new_item'           => __('Nuevo Calendario'),
        'view_item'          => __('Ver Calendario'),
        'search_items'       => __('Buscar Calendarios'),
        'not_found'          => __('No se encontraron Calendarios'),
        'not_found_in_trash' => __('No se encontraron Calendarios en la papelera'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => 'easycal-admin-menu',
        'query_var'          => true,
        'rewrite'            => array('slug' => 'easycal'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'author', 'tag'),
    );

    register_post_type('shortcode', $args);
}

public function easycal_add_admin_menu() {
    add_menu_page(
        __('EasyCal', 'easy-cal'),
        __('EasyCal', 'easy-cal'),
        'manage_options',
        'easycal-admin-menu',
        false,
        'dashicons-calendar-alt',
        30
    );
}

public function easycal_add_shortcode_metabox() {
    add_meta_box(
        'shortcode_metabox',
        __('Codigo del Calendario', 'easycal'),
        array($this, 'easycal_shortcode_metabox_content'),
        'shortcode',
        'side',
        'high'
    );
}

public function easycal_shortcode_metabox_content($post) {
    $shortcode = get_post_meta($post->ID, '_shortcode_value', true);
    ?>
    <p><strong><?php _e('Shortcode:', 'easycal'); ?></strong></p>
    <input type="text" readonly="readonly" value="<?php echo esc_attr($shortcode); ?>" onclick="this.select();" />
    <?php
}

public function easycal_generate_and_save_shortcode($post_id) {
    if (get_post_type($post_id) !== 'shortcode') {
        return;
    }

    $shortcode = '[easycal id="' . $post_id . '"]';
    update_post_meta($post_id, '_shortcode_value', $shortcode);
}

public function easycal_add_shortcode_column($columns) {
    $new_columns = array();
    $new_columns['shortcode'] = __('Shortcode', 'easycal');
    
    // Inserta la columna 'Shortcode' después de la primera columna
    $position = 2;
    $columns = array_slice($columns, 0, $position, true) +
                $new_columns +
                array_slice($columns, $position, null, true);

    return $columns;
}

public function easycal_display_shortcode_column($column, $post_id) {
    if ($column === 'shortcode') {
        $shortcode = get_post_meta($post_id, '_shortcode_value', true);
        echo '<input type="text" readonly="readonly" class="shortcode_input_style" value="' . esc_attr($shortcode) . '" />';
    }
}

public function easycal_enqueue_styles() {
    wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/easycal-admin.css', array(), $this->version, 'all');
}

public function easycal_enqueue_scripts() {
    wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/easycal-admin.js', array('jquery'), $this->version, false);
}

}
