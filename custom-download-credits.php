<?php
/**
 * Plugin Name: Credit Download System
 * Description: Download files with modular credit system
 * Version: 1.0
 * Author: Ahmet Sezgin
 * Author URI: https://github.com/ahmetsezginn
 */

defined('ABSPATH') || exit;

define('CDC_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CDC_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once CDC_PLUGIN_PATH . 'includes/class-download-handler.php';
require_once CDC_PLUGIN_PATH . 'includes/class-credit-manager.php';
require_once CDC_PLUGIN_PATH . 'admin/class-credit-admin.php';
require_once CDC_PLUGIN_PATH . 'admin/class-user-profile.php';
require_once CDC_PLUGIN_PATH . 'public/class-download-button.php';
require_once CDC_PLUGIN_PATH . 'admin/class-product-settings.php';
require_once CDC_PLUGIN_PATH . 'includes/class-credit-helper.php';
require_once CDC_PLUGIN_PATH . 'public/class-public-account.php';


add_action('plugins_loaded', 'init_cdc_plugin');
function init_cdc_plugin() {
    if (!class_exists('WooCommerce')) {
        add_action('admin_notices', function() {
            echo '<div class="error"><p>WooCommerce gerekli!</p></div>';
        });
        return;
    }
    
    CDC_Download_Handler::init();
    CDC_Credit_Admin::init();
    CDC_User_Profile::init();
    CDC_Download_Button::init();
    CDC_Product_Settings::init();
    CDC_Account_Integration::init();
}