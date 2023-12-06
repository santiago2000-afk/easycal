<?php

class Easycal_Admin {

	private $plugin_name;

	private $version;

	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}
 
	public function easycal_add_admin_menu() {

		add_menu_page( 
			__('easyCal'), 
			__('easyCal'), 
			'manage_options', 
			'easycal-admin-menu', 
			array( $this, 'easycal_admin_menu_page' ), 
			'dashicons-calendar-alt', 
			30
		);
	}

	public function easycal_admin_menu_page () {

		$render = esc_html( 'Hola mundo' );

		echo $render;
	}

	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/easycal-admin.css', array(), $this->version, 'all' );

	}

	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/easycal-admin.js', array( 'jquery' ), $this->version, false );

	}

}
