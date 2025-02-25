<?php
defined('ABSPATH') || exit;

class CDC_User_Profile {
    public static function init() {
        add_action('show_user_profile', [self::class, 'add_credit_field']);
        add_action('edit_user_profile', [self::class, 'add_credit_field']);
        add_action('personal_options_update', [self::class, 'save_credit_field']);
        add_action('edit_user_profile_update', [self::class, 'save_credit_field']);
    }

    public static function add_credit_field($user) {
        if (!current_user_can('manage_options')) return;
        $credit = get_user_meta($user->ID, 'user_credit', true) ?: 0; ?>
        <h3>Credit Management</h3>
        <table class="form-table">
            <tr><th><label>Credit</label></th><td><input type="number" name="user_credit" value="<?= $credit ?>"></td></tr>
        </table>
    <?php }

    public static function save_credit_field($user_id) {
        if (!current_user_can('manage_options')) return;
        update_user_meta($user_id, 'user_credit', intval($_POST['user_credit']));
    }
}