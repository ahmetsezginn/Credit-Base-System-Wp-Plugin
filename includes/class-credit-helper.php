<?php
defined('ABSPATH') || exit;

class CDC_Credit_Helper {
    public static function get_product_credit($product_id) {
        $is_credit = get_post_meta($product_id, '_is_credit_product', true) === 'yes';
        return $is_credit ? (int)get_post_meta($product_id, '_credit_amount', true) : 0;
    }
}