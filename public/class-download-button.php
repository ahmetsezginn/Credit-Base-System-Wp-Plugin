<?php
defined('ABSPATH') || exit;

class CDC_Download_Button {
    public static function init() {
        add_action('woocommerce_after_add_to_cart_button', [self::class, 'add_button']);
    }

    public static function add_button() {
        global $product;
        if ($product->is_downloadable() && $product->is_type('simple')) {
            $nonce = wp_create_nonce('download_' . $product->get_id());
            $url = add_query_arg([
                'custom_download' => $product->get_id(),
                'nonce' => $nonce
            ], home_url('/'));
            echo '<a href="' . esc_url($url) . '" class="button">Download with your credit</a>';
        }
        if (isset($_GET['credit_error']) && $_GET['credit_error'] == '1') {
            echo '<div class="woocommerce-error" style="color:red">You dont have enought credit!</div>';
        }
    }
}