<?php

use Theme\Inc\Lib\Component;

final class FooterComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/FooterComponent.template.php';
    }
}