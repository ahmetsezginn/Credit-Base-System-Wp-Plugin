<?php


defined('ABSPATH') || exit;

class CDC_Credit_Manager {
    public static function init() {

        add_action('woocommerce_order_status_processing', [self::class, 'add_credit_on_purchase']);
        
    }

    public static function add_credit_on_purchase($order_id) {
        $order = wc_get_order($order_id);
        $user_id = $order->get_user_id();
        if (!$user_id) return;

        foreach ($order->get_items() as $item) {
            $product = $item->get_product();
            $credit = CDC_Credit_Helper::get_product_credit($product->get_id());
            
            if ($credit > 0) {
                $current = get_user_meta($user_id, 'user_credit', true) ?: 0;
                update_user_meta($user_id, 'user_credit', $current + $credit);
            }
        }
    }
}


CDC_Credit_Manager::init();