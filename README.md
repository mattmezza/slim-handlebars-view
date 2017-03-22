# Slim Framework Handlebars View

[![Build Status](https://travis-ci.org/mattmezza/slim-handlebars-view.svg?branch=master)](https://travis-ci.org/mattmezza/slim-handlebars-view)

This is a Slim Framework view helper built on top of the Handlebars templating component. You can use this component to create and render templates in your Slim Framework application. It works with [handlebars.php by xamin project](https://github.com/XaminProject/handlebars.php).

## Install

Via [Composer](https://getcomposer.org/)

```bash
$ composer require mattmezza/slim-handlebars-view
```

Requires Slim Framework 3 and PHP 5.5.0 or newer.

## Usage

```php
// Create Slim app
$app = new \Slim\App();

// Fetch DI Container
$container = $app->getContainer();

// Register Twig View helper
$container['view'] = new \Slim\Views\Handlebars(
    'path/to/templates',
    'partials',
    [
        'extension' => 'hbs' // default is html
    ]);

// Define named route
$app->get('/hello/{name}', function ($request, $response, $args) {
    return $this->view->render($response, 'profile', [
        'name' => $args['name']
    ]);
})->setName('profile');

// Run app
$app->run();
```

## Testing

```bash
phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Matteo Merola](https://github.com/mattmezza)

## License

The MIT License (MIT). Please see [License File](license.md) for more information.