<?php

use Freekattema\Wp\Components\Component;

final class FooterComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/FooterComponent.template.php';
    }
}