# Slim Handlebars

Repository built from original jayc89/slim-handlebars, kudos to jayc89 thank you for the great
start. There was a bunch of things I needed with Handlebars and Slim that was not possible
to do without modifying the orginal code. I added and made sure you can use custom extensions.
I also added the ability to add your own helpers using a addHelper method.
This repository contains a custom View class for Handlebars (https://github.com/mardix/Handlebars). 
You can use the custom View class by either requiring the appropriate class in your 
Slim Framework bootstrap file and initialize your Slim application using an instance of 
the selected View class or using Composer (the recommended way).


## How to Install

#### using [Composer](http://getcomposer.org/)

Create a composer.json file in your project root:
    
```json
{
    "require": {
        "radicaldrew/slim-handlebars": "dev-master"
    }
}
```

Then run the following composer command:

```bash
$ php composer.phar install
```

## How to use
    
```php
<?php
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
    'view' => new \Slim\Handlebars\Handlebars()
));
```

To use Handlebars options do the following:
    
```php
$view = $app->view();
$view->setTemplatesDirectory('./views');
$view->parserOptions = array(
    'partialsDirectory' => './views/partials',
    'templateExtension' => 'html'
);
```

Templates (suffixed with .html in the example above) are assumed to be located within <doc root>/templates. An optional sub-directory of partials (<doc root>/templates/partials) can also be used.

To render the templates within your routes:
    
```php
$app->get('/', function () use ($app) {
    $array = array();
    $app->render("home", $array);
});
```

## How to add Registered Helpers
```php
$view = $app->view();
$view->addHelper("upper",function($template, $context, $args, $source){
                                return strtoupper($context->get($args));
                         });
```



## Authors
[Andrew Karp](https://github.com/radicaldrew)

based on this original repistory
[Jamie Cressey](https://github.com/jayc89)

## License

MIT Public License
