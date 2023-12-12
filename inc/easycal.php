<?php

class Easycal {


	protected $loader;

	protected $plugin_name;

	protected $version;

	public function __construct() {
		if ( defined( 'EASYCAL_VERSION' ) ) {
			$this->version = EASYCAL_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'easycal';

		$this->easycal_load_dependencies();
		$this->easycal_set_locale();
		$this->easycal_define_admin_hooks();
		$this->easycal_define_public_hooks();

	}

	private function easycal_load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/easycal-loader.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/easycal-i18n.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/easycal-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/easycal-public.php';

		$this->loader = new Easycal_Loader();

	}

	private function easycal_set_locale() {

		$plugin_i18n = new Easycal_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'easycal_load_plugin_textdomain' );

	}

	private function easycal_define_admin_hooks() {

		if(is_admin()) {

			$plugin_admin = new Easycal_Admin( $this->get_plugin_name(), $this->get_version() );

			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
			$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
			$this->loader->add_action( 'admin_menu', $plugin_admin, 'easycal_add_admin_menu' );
		    $this->loader->add_action( 'init', $plugin_admin, 'easycal_init_post_type' );
		}
	}

	private function easycal_define_public_hooks() {

		$plugin_public = new Easycal_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	public function easycal_run() {
		$this->loader->easycal_run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}

}
