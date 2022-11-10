# Components

This folder contains all the components used in the theme. Each component is a self-contained piece of code that can be
used in any page or post. The components are built using standard php, html, css and typescript.

## How to use

### Creating a new component

```bash
$ npm run create-component
```

will open a prompt asking what you want to name the component.
The component will be suffixed with 'Component'

Next it will ask you if you want to add scss and typescript files.

```bash
? Configure component: ›  
Instructions:
    ↑/↓: Highlight option
    ←/→/[space]: Toggle selection
    a: Toggle all
    enter/return: Complete answer
◉   SCSS
◯   TS
```

Afer choosing the component will be generated.

### Displaying a component

To display a component get it and use the public render method like so:

```php
<?php
    HeaderComponent::get()->render();
?>
```

### Passing data to a component

To pass data to a component you can pass an array to the static get parameter like so:

```php
<?php
    HeaderComponent::get([
        'title' => 'Hello World'
    ])->render();
?>
```

### Accessing data in a component

To access the data in a component template you can use the following class:

```php
<?php 
    /** Components/HeaderComponent/HeaderComponent.template.php */
    use ZigZag\Components\ComponentData;

    $title = ComponentData::data()->get('title', 'default-value');
?>
```

## Scoped styles and scripts

On default all components will have a ``*.export.scss`` stylesheet.
These stylesheets are saved in the ``dist`` folder and are not included in the theme.
When rendering the component it will automatically include the stylesheet. The same goes for typescript files.

## Configuration

### Preloading

By default all components will load their stylesheets on page load.
You can change this by overwriting the ``preload_css`` method in the component class.

```php
<?php

use Engine\lib\Component;

final class HeaderComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/HeaderComponent.template.php';
    }
    
    protected function preload_css(): bool
    {
        // returning true will load the stylesheet after page load
        return true;
    }
}
?>
```

### Changing the component template

When you generate a component it will by default create a template file called ``*Component.template.php``
You can change this by overwriting the ``get_template`` method in the component class.

```php
<?php

use Engine\lib\Component;

final class HeaderComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/my-other-template.php';
    }
}
?>
```

## Handy functions

### on_init

The ``on_init`` method is called when the component is initialized.
you can overwrite this method to add custom functionality to the component.

```php
<?php

use Engine\lib\Component;

final class HeaderComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/HeaderComponent.template.php';
    }
    
    protected function on_init(): void
    {
        // do something
    }
}
```

### before_render

The ``before_render`` method is called before the component is rendered.
you can overwrite this method to add custom functionality to the component.
Returning false will prevent the component from rendering.

```php
<?php

use Engine\lib\Component;

final class HeaderComponent extends Component {
    function get_template(): string
    {
        return __DIR__ . '/HeaderComponent.template.php';
    }
    
    protected function before_render(): bool
    {
        // Here you can do some checks to see if the component should render
        return true;
    }
}
```

[Back to home](../README.md)