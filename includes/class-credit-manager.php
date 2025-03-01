<?php
defined('ABSPATH') || exit;

class CDC_Credit_Manager {
    public static function init() {
        add_action('woocommerce_order_status_processing', [self::class, 'add_credit_on_purchase']);
    }

    public static function add_credit_on_purchase($order_id) {
        $order = wc_get_order($order_id);
        $user_id = $order->get_user_id();
        
        // Çifte eklemeyi önle
        if (!$user_id || $order->get_meta('_credits_added') === 'yes') return;

        foreach ($order->get_items() as $item) {
            $product = $item->get_product();
            $quantity = $item->get_quantity(); // Miktarı al
            $credit = CDC_Credit_Helper::get_product_credit($product->get_id());
            
            if ($credit > 0) {
                $current = get_user_meta($user_id, 'user_credit', true) ?: 0;
                $total_credit_to_add = $credit * $quantity; // Miktarla çarp
                update_user_meta($user_id, 'user_credit', $current + $total_credit_to_add);
            }
        }

        // İşlem tamamlandı işaretini ekle
        $order->update_meta_data('_credits_added', 'yes');
        $order->save();
    }
}

CDC_Credit_Manager::init();
