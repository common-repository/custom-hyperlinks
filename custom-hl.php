<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.techmuzz.com
 * @since             1.0.0
 * @package           Custom_Hyperlinks
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Hyperlinks
 * Plugin URI:        https://github.com/techmuzz/custom-hyperlinks
 * Description:       This plugin helps update and/or customize hyperlinks in post content.
 * Version:           1.0.1
 * Author:            TechMuzz
 * Author URI:        https://www.techmuzz.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-hl
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
define( 'CUSTOM_HL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-hl-activator.php
 */
function activate_custom_hl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-hl-activator.php';
	Custom_HL_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-hl-deactivator.php
 */
function deactivate_custom_hl() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-hl-deactivator.php';
	Custom_HL_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_hl' );
register_deactivation_hook( __FILE__, 'deactivate_custom_hl' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-hl.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_hl() {

	$plugin = new Custom_HL();
	$plugin->run();

}
run_custom_hl();
