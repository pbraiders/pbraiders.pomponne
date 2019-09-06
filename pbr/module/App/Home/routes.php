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

    $pApplication->get($sBasePath, \Pbraiders\App\Home\Mediator::class . ':getAction');
};
