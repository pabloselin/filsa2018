<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://apie.cl
 * @since             1.0.0
 * @package           Filsa2018
 *
 * @wordpress-plugin
 * Plugin Name:       FILSA 2018 - PWA
 * Plugin URI:        https://camaradellibro.cl/
 * Description:       Funciones para FILSA 2018 y PWA
 * Version:           1.0.0
 * Author:            Pablo Selín Carrasco Armijo - A Pie
 * Author URI:        https://apie.cl
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       filsa2018
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
define( 'PLUGIN_NAME_VERSION', '1.0.0' );
define( 'FB_APPID', 1048728495191929);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-filsa2018-activator.php
 */
function activate_filsa2018() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-filsa2018-activator.php';
	Filsa2018_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-filsa2018-deactivator.php
 */
function deactivate_filsa2018() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-filsa2018-deactivator.php';
	Filsa2018_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_filsa2018' );
register_deactivation_hook( __FILE__, 'deactivate_filsa2018' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-filsa2018.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_filsa2018() {

	$plugin = new Filsa2018();
	$plugin->run();

}
run_filsa2018();
