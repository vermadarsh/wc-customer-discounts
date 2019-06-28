<?php
if (!defined('ABSPATH')) exit;

$discount_types = array(
    0 => array(
        'slug' => 'global-discount',
        'title' => esc_html__('Global Discount', 'wc-customer-discounts'),
        'description' => esc_html__('This discount will work globally on all the products for all the user roles.', 'wc-customer-discounts'),
    ),
    1 => array(
        'slug' => 'user-role-discount',
        'title' => esc_html__('User Role Discount', 'wc-customer-discounts'),
        'description' => esc_html__('This discount will work globally on the basis of which user role is currently logged in.', 'wc-customer-discounts'),
    ),
    3 => array(
        'slug' => 'user-specific-discount',
        'title' => esc_html__('User Specific Discount', 'wc-customer-discounts'),
        'description' => esc_html__('This discount will work globally on the basis of which user is currently logged in.', 'wc-customer-discounts'),
    ),
);
?>
<div class="wrap">
    <h2><?php esc_html_e('Customer Discounts Settings', 'wc-customer-discounts'); ?></h2>
    <div class="wccd-discout-container">
        <div class="wccd-discounts">
            <select>
                <option value=""><?php esc_html_e('Select discount', 'wc-customer-discounts'); ?></option>
                <?php foreach ($discounts as $discount_type) { ?>
                    <option <?php echo ('global-discount' === $discount_type['slug']) ? 'selected' : ''; ?>
                            value="<?php echo $discount_type['slug']; ?>"><?php echo $discount_type['title']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="wccd-discount-settings">
            <div class="wccd-content-loader">
                <img src="<?php echo includes_url('images/spinner-2x.gif'); ?>" alt="Loader"/>
                <p><?php esc_html_e('Please wait while the content loads...', 'wc-customer-discounts'); ?></p>
            </div>
        </div>
    </div>
</div>
