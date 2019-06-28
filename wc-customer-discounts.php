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
 * Plugin Name:       WooCcommerce Customer Discounts
 * Plugin URI:        https://www.multidots.com/
 * Description:       This plugin allows the administrator to define different sorts of the discounts, customer basis.
 * Version:           1.0.0
 * Author:            Nirav Mehta
 * Author URI:        https://www.multidots.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-customer-discounts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WCCD_PLUGIN_VERSION', '1.0.0');

/**
 * Use this constant to define the current plugin PATH.
 */
if (!defined('WCCD_PLUGIN_PATH')) {
    define('WCCD_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

/**
 * Use this constant to define the current plugin URL.
 */
if (!defined('WCCD_PLUGIN_URL')) {
    define('WCCD_PLUGIN_URL', plugin_dir_url(__FILE__));
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wc-customer-discounts-activator.php
 */
function activate_wc_customer_discounts() {
    require_once WCCD_PLUGIN_PATH . 'includes/class-wc-customer-discounts-activator.php';
    Wc_Customer_Discounts_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wc-customer-discounts-deactivator.php
 */
function deactivate_wc_customer_discounts() {
    require_once WCCD_PLUGIN_PATH . 'includes/class-wc-customer-discounts-deactivator.php';
    Wc_Customer_Discounts_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wc_customer_discounts');
register_deactivation_hook(__FILE__, 'deactivate_wc_customer_discounts');

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

    /**
     * The core plugin class that is used to define internationalization,
     * admin-specific hooks, and public-facing site hooks.
     */
    require WCCD_PLUGIN_PATH . 'includes/class-wc-customer-discounts.php';
    $plugin = new Wc_Customer_Discounts();
    $plugin->run();

}

/**
 * Check plugin requirement on plugins loaded
 * this plugin requires WooCommerce to be installed and active
 */
function wccd_plugin_init() {
    $wc_active = in_array('woocommerce/woocommerce.php', get_option('active_plugins'));
    if (current_user_can('activate_plugins') && $wc_active !== true) {
        add_action('admin_notices', 'wccd_plugin_admin_notice');
    } else {
        run_wc_customer_discounts();
        add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'wccd_admin_plugin_links');
    }
}

add_action('plugins_loaded', 'wccd_plugin_init');

/**
 * Function to show the admin notice, if anyhow WooCommerce plugin is unavailable.
 */
function wccd_plugin_admin_notice() {

    $wccd_plugin = 'WooCommerce Customer Discounts';
    $wc_plugin = 'WooCommerce';

    echo '<div class="error"><p>'
        . sprintf(__('%1$s is ineffective now as it requires %2$s to be installed and active.', 'wc-customer-discounts'), '<strong>' . esc_html($wccd_plugin) . '</strong>', '<strong>' . esc_html($wc_plugin) . '</strong>')
        . '</p></div>';

}

/**
 * This function is defined to add links to the plugin item on the plugins page.
 *
 * @param $links
 * @return array
 */
function wccd_admin_plugin_links($links) {

    $wccd_links = array(
        '<a href="' . admin_url('admin.php?page=wccd-customer-discounts') . '">' . esc_html__('Settings', 'wc-customer-discounts') . '</a>',
        '<a href="javascript:void(0);" class="wccd-developer-support" target="_blank" title="' . esc_html__('Developer Support.', 'wc-customer-discounts') . '">' . esc_html__('Developer Support', 'wc-customer-discounts') . '</a>'
    );

    return array_merge($links, $wccd_links);

}

/**
 * Debug the parameter. Actually the print_r works.
 *
 * @param $p
 */
if (!function_exists('debug')) {

    function debug($p) {
        echo '<pre>';
        print_r($p);
        echo '</pre>';
    }

}

error_reporting(E_ALL);
ini_set('display_errors', 1);