<?php

class Easycal_Admin {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}
 
	function easycal_init_post_type() {
		$labels = array(
			'name'               => 'Shortcodes',
			'singular_name'      => 'Shortcode',
			'menu_name'          => 'Shortcodes',
			'all_items'          => 'Todos los Shortcodes',
			'add_new'            => 'Agregar Nuevo',
			'add_new_item'       => 'Agregar Nuevo Shortcode',
			'edit_item'          => 'Editar Shortcode',
			'new_item'           => 'Nuevo Shortcode',
			'view_item'          => 'Ver Shortcode',
			'search_items'       => 'Buscar Shortcodes',
			'not_found'          => 'No se encontraron shortcodes',
			'not_found_in_trash' => 'No se encontraron shortcodes en la papelera',
		);
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'easycal-admin-menu', // Reemplaza 'tu_menu_padre_slug' con el slug de tu menú padre
			'query_var'          => true,
			'rewrite'            => array('slug' => 'shortcode'),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title', 'editor'),
		);
	
		register_post_type('shortcode', $args);
	}
		
	public function easycal_add_admin_menu() {

		add_menu_page( 
			__('EasyCal', 'easy-cal'), 
			__('EasyCal', 'easy-cal'), 
			'manage_options', 
			'easycal-admin-menu', 
			array( $this, 'easycal_admin_menu_page' ), 
			'dashicons-calendar-alt', 
			30
		);
	}

	public function easycal_admin_menu_page () {

		$render = '<div class="page-main"></div>';

		echo wp_kses( $render, 'h1' );
	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easycal-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycal-admin.js', array( 'jquery' ), $this->version, false );

	}

}
