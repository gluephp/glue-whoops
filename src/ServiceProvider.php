<?php namespace Glue\Whoops;

use Glue\App;
use Glue\Interfaces\ServiceProviderInterface;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\PlainTextHandler;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(App $glue)
    {
        if ($glue->config->get('debug', false) !== true) {
            // We only want to use Whoops if the app is in debug mode
            return;
        }

        $whoops = new Run;

        $logger = $glue->bound('Psr\Log\LoggerInterface')
            ? $glue->make('Psr\Log\LoggerInterface')
            : null;

        $whoops->pushHandler(new PlainTextHandler($logger));
        $whoops->pushHandler(new PrettyPageHandler);
        $whoops->register();

        $glue->singleton('Whoops\Run', function() use($whoops) {
            return $whoops;
        });
    }
}