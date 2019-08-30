<?php

declare(strict_types=1);

/**
 * Define app routes.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App;

use Slim\App;
use Pbraiders\App\Exception;

return static function (App $pApplication) {

    /**
     * Initialize usefull variables.
     */

    /** @var Psr\Container\ContainerInterface $pContainer PSR-11 Container. */
    $pContainer = $pApplication->getContainer();

    /** @var array $aSettings App settings */
    $aSettings = $pContainer->get('settings');

    if (empty($aSettings['application']['website']['url'])) {
        throw new Exception\RuntimeException('The website.url setting is missing in the config file.');
    }

    /** @var string $sRootPath Path of the website */
    $sRootPath = $aSettings['application']['website']['path'];

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
    echo '<pre>', \PHP_EOL;
    print_r($aSettings);
    echo '</pre>', \PHP_EOL;

    // home
    $pApplication->get($sRootPath, function (
        \Psr\Http\Message\ServerRequestInterface $request,
        \Psr\Http\Message\ResponseInterface $response,
        $args
    ) {
        $response->getBody()->write("Hello world!");

        //$a = 1 / 0;
        //trigger_error("notice triggered", E_USER_NOTICE);
        //trigger_error("error triggered", E_USER_ERROR);

        return $response;
    });
};
