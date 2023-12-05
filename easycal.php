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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EASYCAL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-easycal-activator.php
 */
function activate_easycal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easycal-activator.php';
	Easycal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-easycal-deactivator.php
 */
function deactivate_easycal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-easycal-deactivator.php';
	Easycal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easycal' );
register_deactivation_hook( __FILE__, 'deactivate_easycal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-easycal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_easycal() {

	$plugin = new Easycal();
	$plugin->run();

}
run_easycal();
