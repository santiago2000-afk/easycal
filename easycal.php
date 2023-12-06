<?php

/**

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
	require_once plugin_dir_path( __FILE__ ) . 'inc/easycal-activator.php';
	Easycal_Activator::activate();
}

function deactivate_easycal() {
	require_once plugin_dir_path( __FILE__ ) . 'inc/easycal-deactivator.php';
	Easycal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_easycal' );
register_deactivation_hook( __FILE__, 'deactivate_easycal' );

require plugin_dir_path( __FILE__ ) . 'inc/easycal.php';

function run_easycal() {

	$plugin = new Easycal();
	$plugin->easycal_run();

}
run_easycal();
