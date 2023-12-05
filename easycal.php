<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://www.linkedin.com/in/santiago-alvarado-1275601b1/
 * @since             1.0.0
 * @package           Easycal
 *
 * @wordpress-plugin
 * Plugin Name:       EasyCal
 * Plugin URI:        https://https://www.linkedin.com/in/santiago-alvarado-1275601b1/
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            Santiago Alvarado
 * Author URI:        https://https://www.linkedin.com/in/santiago-alvarado-1275601b1//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       easycal
 * Domain Path:       /languages
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'EASYCAL_VERSION', '1.0.0' );

function activate_easycal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easycal-activator.php';
	Easycal_Activator::activate();
}

function deactivate_easycal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easycal-deactivator.php';
	Easycal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easycal' );
register_deactivation_hook( __FILE__, 'deactivate_easycal' );

require plugin_dir_path( __FILE__ ) . 'includes/class-easycal.php';

function run_easycal() {

	$plugin = new Easycal();
	$plugin->run();

}
run_easycal();
