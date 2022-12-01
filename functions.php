<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

include_once "inc/inc.php";

\Freekattema\Wp\ThemeSetup\Theme::get()
    ->HideAdminPosts()
    ->HideAdminComments()
    ->HideAdminTools()
    ->removeDefaultWordpressStyling()
    ->adminBarCleanup()
    ->removeWordpressJquery()
    ->hideMustUsePlugins()
    ->hideAdminDashboard()
    ->hideAdminBar()
    ->hideAdminDashboardWidgets()
    ->registerNavMenus([
        'primary' => 'Primary Menu',
        'footer' => 'Footer Menu',
    ]);


