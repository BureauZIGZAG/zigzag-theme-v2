<?php

namespace Theme\Inc\lib;

abstract class Component {
    private ComponentData $props;

    private string $template;

    protected function __construct(array $props = []) {
        $this->props = new ComponentData($props);
        $this->template = $this->get_template();

        $this->on_init();
    }

    final public static function get(array $props = []) {
        $component = new static($props);
        ComponentAssetsLoader::attach(get_class($component));
        return $component;
    }

    final public function render() {
        if(!$this->before_render()) {
            return;
        }

        if(!file_exists($this->template)) {
            return;
        }
        ComponentData::_set_data($this->props);
        include $this->template;
    }

    abstract function get_template(): string;

    protected function on_init() {}
    protected function before_render(): bool {
        return true;
    }
}
