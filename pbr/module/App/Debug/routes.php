<?php

declare(strict_types=1);

/**
 * Register the routes into the app.
 *
 * @param \Slim\App $pApplication
 * @param string $sBasePath
 * @throws Exception\RuntimeException If settings is missing.
 * @return callable
 */
return static function (\Slim\App $pApplication, string $sBasePath) {

    /**
     * The base path must be set.
     */

    $sBasePath = trim($sBasePath);

    if (strlen($sBasePath) == 0) {
        throw new \Pbraiders\App\Exception\RuntimeException('The base path setting is missing in the config file.');
    }

    /**
     * Defines the routes.
     */

    $pApplication->get($sBasePath . 'debug', \Pbraiders\App\Debug\Mediator::class . ':getAction');
    $pApplication->get($sBasePath . 'debug/{name}', \Pbraiders\App\Debug\Mediator::class . ':getAction');
    $pApplication->get($sBasePath . 'module/{name}', \Pbraiders\App\Debug\Mediator::class . ':getAction');
    #$pApplication->get($sBasePath . 'debug/[{id}]', \Pbraiders\App\Debug\Mediator::class . ':getAction');
    /*
    $pApplication->get($sBasePath . '/debug/container/', \Pbraiders\App\Debug\Mediator::class . ':getContainer');
    $pApplication->get($sBasePath . '/debug/phpini/', \Pbraiders\App\Debug\Mediator::class . ':getPhpIni');
    $pApplication->get($sBasePath . '/debug/phpinfo/', \Pbraiders\App\Debug\Mediator::class . ':getPhpInfo');
    $pApplication->get($sBasePath . '/debug/opcache/', \Pbraiders\App\Debug\Mediator::class . ':getOpCache');
    /*
    $pApplication->group($sBasePath . 'debug', function (\Slim\Routing\RouteCollectorProxy $group) {
        $group->get('/container', \Pbraiders\App\Debug\Mediator::class . ':getContainer');
        $group->get('/phpini', \Pbraiders\App\Debug\Mediator::class . ':getPhpIni');
        $group->get('/phpinfo', \Pbraiders\App\Debug\Mediator::class . ':getPhpInfo');
        $group->get('/opcache', \Pbraiders\App\Debug\Mediator::class . ':getOpCache');
    });
    */
};
