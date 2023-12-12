<?php

class Easycal {


	protected $loader;

	protected $plugin_name;

	protected $version;

	public function __construct() {
		$this->init();
	}

	private function init() {

		$this->version = defined( 'EASYCAL_VERSION' ) ? 'EASYCAL_VERSION' : '1.0.0'; 
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

		if (is_admin()) {
			$this->loader = new Easycal_Loader();
		}

	}

	private function easycal_set_locale() {

		if (is_admin()) {
			$plugin_i18n = new Easycal_i18n();

			if (method_exists($plugin_i18n, 'easycal_load_plugin_textdomain')){
				$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'easycal_load_plugin_textdomain' );
			}
		}
	}

	private function easycal_define_admin_hooks() {

		if (is_admin()) {
			$plugin_admin = new Easycal_Admin($this->get_plugin_name(), $this->get_version());
			$this->easycal_add_admin_hooks($plugin_admin);
		}
	}

	private function easycal_add_admin_hooks($plugin_admin) {
		if (method_exists($plugin_admin, 'easycal_enqueue_styles')) {
			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'easycal_enqueue_styles');
		}

		if (method_exists($plugin_admin, 'easycal_enqueue_scripts')) {
			$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'easycal_enqueue_scripts');
		}

		if (method_exists($plugin_admin, 'easycal_add_admin_menu')) {
			$this->loader->add_action('admin_menu', $plugin_admin, 'easycal_add_admin_menu');
		}

		if (method_exists($plugin_admin, 'easycal_init_post_type')) {
			$this->loader->add_action('init', $plugin_admin, 'easycal_init_post_type');
		}
	}

	private function easycal_define_public_hooks() {

		if(is_admin()){
			$plugin_public = new Easycal_Public( $this->get_plugin_name(), $this->get_version() );
			$this->easycal_add_public_hooks($plugin_public);
		}
	}

	private function easycal_add_public_hooks($plugin_public){
		if (method_exists($plugin_public, 'easycal_enqueue_styles')) {
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'easycal_enqueue_styles' );
		}
		
		if (method_exists($plugin_public, 'easycal_enqueue_scripts')){
			$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'easycal_enqueue_scripts' );
		}
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
