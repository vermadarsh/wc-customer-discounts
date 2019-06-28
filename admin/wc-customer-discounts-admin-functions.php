<?php
if (!defined('ABSPATH')) exit;

/**
 * This function defines the 2 basic discount types.
 *
 * @return array
 */
function wccd_get_basic_discount_types() {

    return array(
        'percent' => esc_html__( 'Percentage', 'wc-customer-discounts' ),
        'fixed' => esc_html__( 'Fixed', 'wc-customer-discounts' )
    );

}

/**
 * Function defined to return the HTML of the global discount settings.
 *
 * @return false|string
 */
function wccd_get_global_discounts_settings_html() {

    $discount_types = wccd_get_basic_discount_types();
    ob_start();
    ?>
    <div class="wccd-global-discount-settings">
        <div class="type">
            <select>
                <option></option>
                <?php foreach( $discount_types as $type ) {?>
                <?php }?>
            </select>
        </div>
    </div>
    <?php
    return ob_get_clean();

}

/**
 * Function defined to return the HTML of the user role discount settings.
 *
 * @return false|string
 */
function wccd_get_user_role_discounts_settings_html() {

    ob_start();
    ?>
    <p>user role discount!</p>
    <?php
    return ob_get_clean();

}

/**
 * Function defined to return the HTML of the user specific discount settings.
 *
 * @return false|string
 */
function wccd_get_user_specific_discounts_settings_html() {

    ob_start();
    ?>
    <p>user specific discount!</p>
    <?php
    return ob_get_clean();

}