you can add also shortcode 
old:
    public static function init() {
        add_action('woocommerce_after_add_to_cart_button', [self::class, 'add_button']);
    }
new:
    public static function init() {
        add_shortcode('cdc_download_button', [self::class, 'add_button']);
    }
when you do this you can also add custom location just add this "[cdc_download_button]" shortcode to your page
