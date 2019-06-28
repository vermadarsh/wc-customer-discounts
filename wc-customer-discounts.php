<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.multidots.com/
 * @since             1.0.0
 * @package           Wc_Customer_Discounts
 *
 * @wordpress-plugin
 * Plugin Name:       WC Customer Discounts
 * Plugin URI:        https://www.multidots.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Nirav Mehta
 * Author URI:        https://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-customer-discounts
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
define( 'WC_CUSTOMER_DISCOUNTS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-customer-discounts-activator.php
 */
function activate_wc_customer_discounts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-discounts-activator.php';
	Wc_Customer_Discounts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-customer-discounts-deactivator.php
 */
function deactivate_wc_customer_discounts() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-discounts-deactivator.php';
	Wc_Customer_Discounts_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wc_customer_discounts' );
register_deactivation_hook( __FILE__, 'deactivate_wc_customer_discounts' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-customer-discounts.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_customer_discounts() {

	$plugin = new Wc_Customer_Discounts();
	$plugin->run();

}
run_wc_customer_discounts();
