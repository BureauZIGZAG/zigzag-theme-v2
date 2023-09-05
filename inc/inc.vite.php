<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
    exit;

define('IS_VITE_DEVELOPMENT', false);

/*
 * VITE & Tailwind JIT development
 * Inspired by https://github.com/andrefelipe/vite-php-setup
 *
 */

// dist subfolder - defined in vite.config.json
define('DIST_DEF', 'dist');

// defining some base urls and paths
define('DIST_URI', get_template_directory_uri() . '/' . DIST_DEF);
define('DIST_PATH', get_template_directory() . '/' . DIST_DEF);

// js enqueue settings
define('JS_DEPENDENCY', array()); // array('jquery') as example
define('JS_LOAD_IN_FOOTER', true); // load scripts in footer?

// deafult server address, port and entry point can be customized in vite.config.json
define('VITE_SERVER', 'http://localhost:3000');
define('VITE_ENTRY_POINT', '/main.ts');

// enqueue hook
add_action( 'wp_enqueue_scripts', function() {
    $manifest = json_decode(file_get_contents(__DIR__ . "/../dist/manifest.json"), false);

    if (is_array($manifest)) {
        foreach ($manifest as $value) {
            if (!$value -> isEntry) {
                continue;
            }

            $js_file = $value -> file;
            if (!empty($js_file)) {
                wp_enqueue_script('main', DIST_URI . '/' . $js_file, JS_DEPENDENCY, '', JS_LOAD_IN_FOOTER);
            }

            foreach ($value -> css as $css_file) {
                wp_enqueue_style('main', DIST_URI . '/' . $css_file);
            }
        }
    }
});