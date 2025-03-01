<h1>You Can Add Also Create Shortcode </h1>
<h3>Old:</h3>
    <p>public static function init() {<br>
        add_action('woocommerce_after_add_to_cart_button', [self::class, 'add_button']);<br>
    }</p>
<h3>New:<h3>
    <p>public static function init() {<br>
        add_shortcode('cdc_download_button', [self::class, 'add_button']);<br>
    }</p>
<p>When you do this you can also add custom location just add this "[cdc_download_button]" shortcode to your page</p>
