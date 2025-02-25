<?php

defined('ABSPATH') || exit;

class CDC_Product_Settings {
    public static function init() {
        add_action('woocommerce_product_options_general_product_data', [self::class, 'add_credit_fields']);
        add_action('woocommerce_process_product_meta', [self::class, 'save_credit_fields']);
        add_action('admin_footer', [self::class, 'add_credit_script']);
    }

    public static function add_credit_fields() {
        echo '<div class="options_group">';

        woocommerce_wp_checkbox([
            'id' => '_is_credit_product',
            'label' => 'Credit Product',
            'description' => 'This product adds credit to user account when purchased.'
        ]);
        
        woocommerce_wp_text_input([
            'id' => '_credit_amount',
            'label' => 'Credit Amount',
            'type' => 'number',
            'custom_attributes' => ['step' => '1', 'min' => '0'],
            'wrapper_class' => 'show_if_credit_product'
        ]);
        
        echo '</div>';
    }

    public static function save_credit_fields($product_id) {
        $is_credit = isset($_POST['_is_credit_product']) ? 'yes' : 'no';
        $credit_amount = isset($_POST['_credit_amount']) ? absint($_POST['_credit_amount']) : 0;

        update_post_meta($product_id, '_is_credit_product', $is_credit);
        update_post_meta($product_id, '_credit_amount', $credit_amount);
    }

    public static function add_credit_script() {
        global $post;
        if ($post && 'product' === $post->post_type) {
            ?>
            <script>
            jQuery(document).ready(function($){
                function toggleCreditField() {
                    if ($('#_is_credit_product').is(':checked')) {
                        $('.show_if_credit_product').show();
                    } else {
                        $('.show_if_credit_product').hide();
                    }
                }
                
                toggleCreditField();
                $('#_is_credit_product').change(toggleCreditField);
            });
            </script>
            <style>
            .show_if_credit_product { display: none; }
            </style>
            <?php
        }
    }
}
