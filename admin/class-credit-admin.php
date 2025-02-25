<?php


class CDC_Credit_Admin {
    public static function init() {
        add_action('admin_menu', [self::class, 'add_admin_menu']);
    }

    public static function add_admin_menu() {
        add_menu_page(
            'Credit Management',
            'Credit Management',
            'manage_options',
            'credit-management',
            [self::class, 'render_admin_page'],
            'dashicons-money-alt',
            30
        );
    }
    public static function render_admin_page() {
        if (!current_user_can('manage_options')) wp_die('You do not have permission!');
        
        if (isset($_POST['update_credits'])) {
            $user_id = intval($_POST['user_id']);
            $new_credit = intval($_POST['credit']);
            update_user_meta($user_id, 'user_credit', $new_credit);
            echo '<div class="notice notice-success"><p>Credit updated</p></div>';
        }

  
        $users = get_users(array(
            'fields' => array('ID', 'display_name', 'user_email')
        ));
        ?>
        <div class="wrap">
            <h1>Credit Management</h1>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>E-mail</th>
                        <th>Available Credit</th>
                        <th>Process</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): 
                        $credit = get_user_meta($user->ID, 'user_credit', true) ?: 0;
                    ?>
                    <tr>
                        <td><?php echo esc_html($user->display_name ?: 'Anonymous User'); ?></td>
                        <td><?php echo esc_html($user->user_email); ?></td>
                        <td><?php echo $credit; ?></td>
                        <td>
                            <form method="post">
                                <input type="number" name="credit" value="<?php echo $credit; ?>" style="width:80px;">
                                <input type="hidden" name="user_id" value="<?php echo $user->ID; ?>">
                                <?php submit_button('Update', 'primary', 'update_credits', false); ?>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php
    }
}