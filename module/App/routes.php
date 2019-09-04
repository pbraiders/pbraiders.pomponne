<?php

declare(strict_types=1);

/**
 * Register the routes into the app.
 *
 * @param \Slim\App $pApplication
 * @throws Exception\RuntimeException If settings is missing.
 * @return callable
 */
return static function (\Slim\App $pApplication) {

    /**
     * Initialize usefull variables.
     */

    /** @var \Psr\Container\ContainerInterface $pContainer PSR-11 Container. */
    $pContainer = $pApplication->getContainer();

    /** @var array $aSettings App settings */
    $aSettings = $pContainer->get('settings');

    if (empty($aSettings['application']['website']['url'])) {
        throw new \Pbraiders\App\Exception\RuntimeException('The website.url setting is missing in the config file.');
    }

    /** @var string $sBasePath Path of the website */
    $sBasePath = $aSettings['application']['website']['path'];

    /**
     * Set the cache file for the routes. Note that you have to delete this file
     * whenever you change the routes.
     */
    if (! empty($aSettings['application']['cache_path'])) {
        $pApplication->getRouteCollector()->setCacheFile(
            $aSettings['application']['cache_path'] . \DIRECTORY_SEPARATOR . 'routes.cache'
        );
    }

    /**
     * Defines the routes.
     */

    // home
    /** @var callable $callable */
    $callable = require __DIR__ . \DIRECTORY_SEPARATOR . 'Home' . \DIRECTORY_SEPARATOR . 'routes.php';
    $callable($pApplication, $sBasePath);

    // debug
    $callable = require __DIR__ . \DIRECTORY_SEPARATOR . 'Debug' . \DIRECTORY_SEPARATOR . 'routes.php';
    $callable($pApplication, $sBasePath);
};
