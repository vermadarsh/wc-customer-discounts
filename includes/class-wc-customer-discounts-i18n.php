<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.multidots.com/
 * @since      1.0.0
 *
 * @package    Wc_Customer_Discounts
 * @subpackage Wc_Customer_Discounts/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wc_Customer_Discounts
 * @subpackage Wc_Customer_Discounts/includes
 * @author     Nirav Mehta <nirmehta4491@gmail.com>
 */
class Wc_Customer_Discounts_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wc-customer-discounts',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
