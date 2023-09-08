<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
	exit;


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
define('JS_DEPENDENCY', []); // array('jquery') as example
define('JS_LOAD_IN_FOOTER', true); // load scripts in footer?

// enqueue hook
add_action('wp_enqueue_scripts', function () {
	$manifest_path = __DIR__ . "/../dist/manifest.json";
	if (!file_exists($manifest_path)) {
		return;
	}
	$manifest_content = file_get_contents($manifest_path);
	$manifest_content = json_decode($manifest_content, false);

	if (is_object($manifest_content)) {
		foreach ($manifest_content as $value) {
			if (!isset($value->isEntry)) {
				continue;
			}
			$js_file = $value->file;
			if (!empty($js_file)) {
				wp_enqueue_script('main', DIST_URI . '/' . $js_file, JS_DEPENDENCY, '', JS_LOAD_IN_FOOTER);
			}

			foreach ($value->css as $css_file) {
				wp_enqueue_style('main', DIST_URI . '/' . $css_file);
			}
		}
	}
});
