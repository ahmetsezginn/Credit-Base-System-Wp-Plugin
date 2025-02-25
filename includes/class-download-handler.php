<?php
defined('ABSPATH') || exit;

class CDC_Download_Handler {
    public static function init() {
        add_action('init', [self::class, 'handle_download_request']);
    }

    public static function handle_download_request() {
        if (!isset($_GET['custom_download'], $_GET['nonce'])) return;

        $product_id = intval($_GET['custom_download']);
        $nonce = sanitize_text_field($_GET['nonce']);
        $user_id = get_current_user_id();
        $product_permalink = get_permalink($product_id);
        if (
            !wp_verify_nonce($nonce, 'download_' . $product_id) ||
            !$user_id ||
            (get_user_meta($user_id, 'user_credit', true) < 1)
        ) {
            wp_redirect(add_query_arg('credit_error', '1', $product_permalink));
            exit;
        }

        $product = wc_get_product($product_id);
        if ($product && $product->is_downloadable()) {
            update_user_meta($user_id, 'user_credit', get_user_meta($user_id, 'user_credit', true) - 1);
            $download = reset($product->get_downloads());
            WC_Download_Handler::download($download->get_file(), $product_id);
            exit;
        }
    }
}