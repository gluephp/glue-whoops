# Whoops for Glue

Use [filp/whoops](https://github.com/filp/whoops) with [gluephp/glue](https://github.com/gluephp/glue)

## Installation

Use [Composer](http://getcomposer.org):

```bash
$ composer require gluephp/glue-whoops
```

## Configure Whoops

```php
$app = new Glue\App;

$app->config->override([
    'debug' => true,
]);
```
The `debug` settings isn't specifically for Whoops, but if debug is false, Whoops will be disabled since we don't want to use it in production.

## Register Whoops

```php
$app->register(
    new Glue\Whoops\ServiceProvider()
);
```

## Get the Whoops instance

Once the service provider is registered, you can fetch the Whoops instance with:

```php
$whoops = $app->make('Whoops\Run');
```
