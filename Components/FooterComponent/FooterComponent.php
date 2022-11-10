<?php

final class FooterComponent extends \Engine\lib\Component
{
    function get_template(): string
    {
        return __DIR__ . '/FooterComponent.template.php';
    }
}