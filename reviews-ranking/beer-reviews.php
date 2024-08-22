<?php

/**
 * The plugin file
 *
 * This file is to generate the plugin information in the admin. 
 * It includes the dependencies used by the plugin,
 * The activation and deactivation functions, and defines a function to start the plugin.
 *
 * @link              https://github.com/johnchou71
 * @since             1.0.0
 * @package           Beer_Reviews
 *
 * @wordpress-plugin
 * Plugin Name:       Beer_Reviews
 * Plugin URI:        /Beer_Reviews
 * Description:       Showing the 10 most recent reviews for Spruce Beer from Garrison Brewing Company.
 * Version:           1.0.0
 * Author:            John
 * Author URI:        https://github.com/johnchou71
 * 
*/

// Abort when this file is called directly. 
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Plugin version.
 */

define( 'BEER_REVIEWS_VERSION', '1.0.0' );

/**
 * Running during plugin activation.
 * This action is in the includes/class-beer-reviews-activator.php
 */
function activate_beer_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beer-reviews-activator.php';
	Beer_Reviews_Activator::activate();
}

/**
 * Running during plugin deactivation.
 * This action is in the includes/class-beer-reviews-deactivator.php
 */
function deactivate_beer_reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-beer-reviews-deactivator.php';
	Beer_Reviews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_beer_reviews' );
register_deactivation_hook( __FILE__, 'deactivate_beer_reviews' );

/**
 * The core plugin class is to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-beer-reviews.php';

/**
 * Execution of the plugin.
 *
 * @since    1.0.0
 */
function run_beer_reviews() {

	$plugin = new Beer_Reviews();
	$plugin->run();

}
run_beer_reviews();
