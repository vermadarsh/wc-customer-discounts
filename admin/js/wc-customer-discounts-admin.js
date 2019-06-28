jQuery(document).ready(function ($) {
    'use strict';

    var wccd_fields = {
        /**
         * Initialization Custom My Account Tab Js.
         */
        init: function () {
            $(document.body).on('change', '.wccd-discounts-type select', this.wccdLoadAdminDiscountDetails);
            $(window).on('load', this.wccdLoadAdminDiscountDetails);
        },

        /**
         * Plugin Menu Accordion Toggle.
         * @param event
         */
        wccdLoadAdminDiscountDetails: function (event) {
            event.preventDefault();
            var discount_type = $('.wccd-discounts-type select').val();
            var curr_url = window.location.href;
            if (-1 !== curr_url.indexOf('wccd-customer-discounts')) {
                var data = {
                    'action': 'wccd_load_admin_discount_details',
                    'discount_type': discount_type
                };
                $.ajax({
                    dataType: 'JSON',
                    url: WCCD_Admin_JS_Obj.ajaxurl,
                    type: 'POST',
                    data: data,
                    success: function (response) {
                        if ('wccd-discount-settings-html-returned' === response.data.message) {
                            $('.wccd-discount-settings .wccd-content-loader').remove();
                            $('.wccd-discount-settings').html(response.data.html);
                        }
                    },
                });
            }
        },
    };
    wccd_fields.init();

});
