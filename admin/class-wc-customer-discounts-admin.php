<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Wc_Customer_Discounts
 * @subpackage Wc_Customer_Discounts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Customer_Discounts
 * @subpackage Wc_Customer_Discounts/admin
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Wc_Customer_Discounts_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    function wccd_enqueue_styles() {

        wp_enqueue_style($this->plugin_name, WCCD_PLUGIN_URL . 'admin/css/wc-customer-discounts-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    function wccd_enqueue_scripts() {

        wp_enqueue_script($this->plugin_name, WCCD_PLUGIN_URL . 'admin/js/wc-customer-discounts-admin.js', array('jquery'), $this->version, true);
        wp_localize_script(
            $this->plugin_name,
            'WCCD_Admin_JS_Obj',
            array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'loader_url' => includes_url('images/spinner-2x.gif'),
            )
        );

    }

    /**
     * Adds a submenu to the WC menu item to show the admin settings.
     *
     * @since    1.0.0
     */
    function wccd_admin_menu_items() {

        add_submenu_page(
            'woocommerce',
            esc_html__('Customer Discounts', 'wc-customer-discounts'),
            esc_html__('Customer Discounts', 'wc-customer-discounts'),
            'manage_options',
            'wccd-customer-discounts',
            array($this, 'wccd_customer_discounts_callback')
        );

    }

    /**
     * Holds the template for admin settings.
     *
     * @since    1.0.0
     */
    function wccd_customer_discounts_callback() {

        $file = WCCD_PLUGIN_PATH . 'admin/partials/wccd-admin-settings.php';
        if (file_exists($file)) {
            include_once $file;
        }

    }

    /**
     * Function defined to load the admin settings.
     *
     * @since    1.0.0
     */
    function wccd_load_admin_discount_details() {

        $action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );
        if( isset( $action ) && 'wccd_load_admin_discount_details' === $action ) {
            $discount_type = filter_input( INPUT_POST, 'discount_type', FILTER_SANITIZE_STRING );

            if( 'global-discount' === $discount_type ) {
                $settings_html = wccd_get_global_discounts_settings_html();
            } elseif( 'user-role-discount' === $discount_type ) {
                $settings_html = wccd_get_user_role_discounts_settings_html();
            } elseif( 'user-specific-discount' === $discount_type ) {
                $settings_html = wccd_get_user_specific_discounts_settings_html();
            }

            wp_send_json_success(
                array(
                    'message' => 'wccd-discount-settings-html-returned',
                    'html' => $settings_html
                )
            );
            wp_die();
        }

    }

}