<?php

use Freekattema\Wp\Components\Component;

final class HeaderComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/HeaderComponent.template.php';
    }
}