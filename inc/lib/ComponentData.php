<?php

namespace Engine\lib;

class ComponentData {
    private static $active_instance = null;
    private array $data = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function get(string $key, $default = null) {
        return $this->data[$key] ?? $default;
    }

    public function set(string $key, $value) {
        $this->data[$key] = $value;
    }

    public function has(string $key): bool {
        return isset($this->data[$key]);
    }

    public function remove(string $key) {
        unset($this->data[$key]);
    }

    public function get_all(): array {
        return $this->data;
    }

    public function echo(string $key) {
        if($this->has($key)) {
            echo $this->get($key);
        }
    }

    public static function data(): ComponentData {
        if(self::$active_instance === null) {
            self::$active_instance = new self([]);
        }

        return self::$active_instance;
    }

    public static function _set_data(ComponentData $data) {
        self::$active_instance = $data;
    }
}