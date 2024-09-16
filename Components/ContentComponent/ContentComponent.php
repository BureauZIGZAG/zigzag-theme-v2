<?php

use Freekattema\Wp\Components\Component;

final class ContentComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/ContentComponent.template.php';
    }
}
