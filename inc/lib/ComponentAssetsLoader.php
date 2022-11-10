<?php

namespace Engine\lib;

use Buffer;

final class ComponentAssetsLoader
{
    private string $styleBase = '/dist/exports/scss/';
    private string $scriptBase = '/dist/exports/ts/';

    private static $instance = null;
    private $components = [];

    private array $enqueue_footer = [];
    private array $enqueue_header = [];

    private function __construct()
    {
        $this->init();
        add_action('wp_footer', function() {
            $this->calc();
        });
    }

    private function init() {
        if(!is_user_logged_in()) {
            $this->get_transients();
        }
    }

    private function calc()
    {
        $footer = implode('', $this->enqueue_footer);
        $header = implode('', $this->enqueue_header);

        Buffer::add_replace_rule(
            '/<\/head>/',
            $header . '</head>'
        );

        Buffer::add_replace_rule(
            '/<\/body>/',
            $footer . '</body>'
        );
    }

    public static function get(): ComponentAssetsLoader
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function attach(string $component, bool $preload_css = false)
    {
        if(!in_array($component, $this->components)) {
            $this->components[] = $component;
            $this->get_assets_from_component($component, $preload_css);
        }

        $this->after_attach();
    }

    private function after_attach() {
        if(is_user_logged_in()) {
            $page = get_the_ID();
            $transient = "zz_assets_$page";
            set_transient($transient, $this->components, 60 * 60 * 24);
            $styleTransient = "zz_styles_$page";
            set_transient($styleTransient, $this->enqueue_header, 60 * 60 * 24);
            $scriptTransient = "zz_scripts_$page";
            set_transient($scriptTransient, $this->enqueue_footer, 60 * 60 * 24);
        }
    }

    private function get_transients() {
        $page = get_the_ID();
        $transient = "zz_assets_$page";
        $styleTransient = "zz_styles_$page";
        $scriptTransient = "zz_scripts_$page";

        $components = get_transient($transient);
        $styles = get_transient($styleTransient);
        $scripts = get_transient($scriptTransient);

        $this->components = is_array($components) ? $components : [];
        $this->enqueue_header = is_array($styles) ? $styles : [];
        $this->enqueue_footer = is_array($scripts) ? $scripts : [];
    }

    private function get_assets_from_component(string $component, bool $preload_css = false)
    {
        $theme = get_template_directory();
        $themeUrl = get_template_directory_uri();

        $styleName = $this->styleBase . $component . '.css';
        $scriptName = $this->scriptBase . $component . '.js';

        if (file_exists($theme . $styleName)) {
            $styleUrl = $themeUrl . $styleName;
            $this->enqueue_header[] = $this->get_style_element($styleUrl, $preload_css);
        }

        if (file_exists($theme . $scriptName)) {
            $scriptUrl = $themeUrl . $scriptName;
            $this->enqueue_footer[] = "<script defer src='$scriptUrl'></script>";
        }
    }

    private function get_script_element(string $scriptUrl): string
    {
        return "<script defer src='$scriptUrl'></script>";
    }

    private function get_style_element(string $styleUrl, bool $preload_css = false): string
    {
        if(!$preload_css){
            return "<link rel='stylesheet' href='$styleUrl' />";
        } else {
            return "<link rel='defer-css' href='$styleUrl' /> <noscript><link rel='stylesheet' href='$styleUrl' /></noscript>";
        }
    }
}