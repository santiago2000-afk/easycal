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
            'all_items'          => __('Todos los Calendarios'),
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
            'supports'           => array('title','editor'),
        );

        register_post_type('shortcode', $args);
    }

    public function easycal_add_admin_menu() {
        add_menu_page(
            __('EasyCal', 'easy-cal'),
            __('EasyCal', 'easy-cal'),
            'manage_options',
            'easycal-admin-menu',
            array($this, 'easycal_admin_menu_page'),
            'dashicons-calendar-alt',
            30
        );
    }

    public function easycal_admin_menu_page() {
        $render = '<div class="page-main"></div>';
        echo wp_kses($render, 'h1');
    }

    public function easycal_generate_and_save_shortcode($post_id) {
        if (get_post_type($post_id) !== 'shortcode') {
            return;
        }

        $shortcode = '[mi_shortcode id="' . $post_id . '"]';
        update_post_meta($post_id, '_shortcode_value', $shortcode);
    }

	public function easycal_add_shortcode_column($columns) {
		$columns['shortcode'] = __('Shortcode', 'easycal');
		return $columns;
	}
	
    public function easycal_display_shortcode_column($column, $post_id) {
        if ($column === 'shortcode') {
            $shortcode = get_post_meta($post_id, '_shortcode_value', true);
            echo '<input type="text" readonly="readonly" value="' . esc_attr($shortcode) . '" onclick="this.select();" />';
        }
    }

    public function easycal_enqueue_styles() {
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/easycal-admin.css', array(), $this->version, 'all');
    }

    public function easycal_enqueue_scripts() {
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/easycal-admin.js', array('jquery'), $this->version, false);
    }

}
