<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

include_once "inc/inc.php";

// PHP Console log function
function console_log(...$data): void
{
    echo "<script>console.log(" . json_encode($data) . ");</script>";
}

// Remove default Gravity Forms styling
add_filter('gform_disable_form_theme_css', '__return_true');


\Freekattema\Wp\ThemeSetup\Theme::init([
    'hide_admin_posts' => true,
    'hide_admin_comments' => true,
    'hide_admin_tools' => true,
    'remove_default_wordpress_styling' => true,
    'remove_wordpress_jquery' => true,
    'hide_must_use_plugins' => true,
    'hide_admin_dashboard' => true,
    'hide_admin_bar' => true,
    'admin_bar_cleanup' => true,
    'hide_admin_dashboard_widgets' => true,
    'register_nav_menus' => [
        'main-menu' => 'Main Menu',
        'footer-menu' => 'Footer Menu',
    ],
]);

