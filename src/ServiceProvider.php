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
        $whoops = new Run;

        $logger = $glue->bound('Psr\Log\LoggerInterface')
            ? $glue->make('Psr\Log\LoggerInterface')
            : null;

        $whoops->pushHandler(new PlainTextHandler($logger));

        if ($glue->config->get('debug', false) !== true) {
            $whoops->pushHandler(new ProductionHandler($logger));
        } else {
            $whoops->pushHandler(new PrettyPageHandler($logger));
        }

        $whoops->register();

        $glue->singleton('Whoops\Run', function() use($whoops) {
            return $whoops;
        });
    }
}
