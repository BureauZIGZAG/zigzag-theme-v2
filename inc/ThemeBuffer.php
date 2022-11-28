<?php

final class ThemeBuffer {
    private static ?ThemeBuffer $instance = null;

    private static array $replace = [];
    private static array $in_header = [];
    private static array $in_footer = [];

    private function __construct() {
        ob_start(function($content) {
            $this->before_replace();

            foreach(self::$replace as $rule) {
                $content = preg_replace($rule[0], $rule[1], $content);
            }

            return $content;
        });
    }

    private function before_replace(): void
    {
        $headerRules = implode(' ', self::$in_header);
        $footerRules = implode(' ', self::$in_footer);

        self::$replace[] = [
            "/<\/head>/",
            $headerRules . "\n</head>"
        ];

        self::$replace[] = [
            "/<\/body>/",
            $footerRules . "\n</body>"
        ];
    }

    public static function init(): void
    {
        if (self::$instance == null) {
            self::$instance = new ThemeBuffer();
        }
    }

    public static function replace(string $search, string $replace): void
    {
        if(!self::is_valid_regex($search)) {
            $search = preg_quote($search);
        }

        self::$replace[] = [$search, $replace];
    }

    public static function add_to_header(string $content): void
    {
        self::$in_header[] = $content;
    }

    public static function add_to_footer(string $content): void
    {
        self::$in_footer[] = $content;
    }

    public static function add_css(string $path): void
    {
        self::add_to_header("<link rel='stylesheet' href='$path'>");
    }

    public static function add_js(string $path, $defer = true): void
    {
        $defer = $defer ? 'defer' : '';
        self::add_to_footer("<script src='$path' $defer></script>");
    }

    private static function is_valid_regex(string $regex): bool
    {
        return @preg_match($regex, '') !== false;
    }
}

ThemeBuffer::init();