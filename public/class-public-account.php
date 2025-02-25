<?php


defined('ABSPATH') || exit;

class CDC_Account_Integration {
    public static function init() {

        add_filter('woocommerce_account_menu_items', [self::class, 'add_credit_tab']);
        

        add_action('woocommerce_account_credits_endpoint', [self::class, 'render_credit_content']);
        

        add_action('init', [self::class, 'add_endpoint']);
    }


    public static function add_credit_tab($menu_items) {
        $menu_items['credits'] = 'My Credits';
        return $menu_items;
    }


    public static function render_credit_content() {
        $user_id = get_current_user_id();
        $credit = get_user_meta($user_id, 'user_credit', true) ?: 0;
        ?>
        <div class="woocommerce-MyAccount-content-credits">
            <h3>Credit Balance</h3>
            <?php echo $credit; ?>
            </div>
        </div>
        <?php
    }


    public static function add_endpoint() {
        add_rewrite_endpoint('credits', EP_ROOT | EP_PAGES);
    }
}


CDC_Account_Integration::init();