<?php

namespace Theme\Inc\Lib;

final class ComponentAssetsLoader
{
    private string $cssBase = 'dist/exports/css/';
    private string $jsBase = 'dist/exports/js/';

    private array $css = [];
    private array $js = [];

    private static $instance = null;

    private function __construct()
    {
        ob_start(function($content) {
            return $this->parse($content);
        });
    }

    public static function get(): ComponentAssetsLoader
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function attach(string $component)
    {
        $css = $this->cssBase . $component . '.css';
        $js = $this->jsBase . $component . '.js';

        if (file_exists(get_template_directory() . '/' . $css)) {
            $this->css[] = $css;
        }

        if (file_exists(get_template_directory() . '/' . $js)) {
            $this->js[] = $js;
        }
    }

    private function get_script_element(string $scriptUrl): string
    {
        return "<script defer src='$scriptUrl'></script>";
    }

    private function get_style_element(string $styleUrl): string
    {
        return "<link rel='stylesheet' href='$styleUrl' />";
    }

    private function parse($content)
    {
        $content = $this->place_css($content);
        $content = $this->place_js($content);

        return $content;
    }

    private function place_css($content)
    {
        $css = array_map(function($styleUrl) {
            return $this->get_style_element(get_template_directory_uri() . '/' . $styleUrl);
        }, $this->css);

        $css = implode('', $css);

        return str_replace('</head>', $css . '</head>', $content);
    }

    private function place_js($content)
    {
        $js = array_map(function($scriptUrl) {
            return $this->get_script_element(get_template_directory_uri() . '/' . $scriptUrl);
        }, $this->js);

        $js = implode('', $js);

        return str_replace('</body>', $js . '</body>', $content);
    }
}