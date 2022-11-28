<?php

namespace Theme\Inc\Lib;

final class ComponentAssetsLoader
{
    private function __construct() {}

    public static function attach(string $component)
    {
        $cssFile = '/dist/exports/' . $component . '.css';
        if (file_exists(get_template_directory() . $cssFile)) {
            \ThemeBuffer::add_css(get_template_directory_uri() . $cssFile);
        }
    }
}