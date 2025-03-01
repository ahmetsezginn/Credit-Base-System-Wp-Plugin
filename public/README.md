you can add also shortcode 
new:
    public static function init() {
        add_shortcode('cdc_download_button', [self::class, 'add_button']);
    }
