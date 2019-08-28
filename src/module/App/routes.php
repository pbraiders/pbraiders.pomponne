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
     * PSR-11 Container.
     *
     * @var Psr\Container\ContainerInterface $pContainer
     */
    $pContainer = $pApplication->getContainer();

    /**
     * Settings.
     *
     * @var array $aSettings
     */
    $aSettings = $pContainer->get('settings');

    /**
     * Path of the website.
     *
     * @var string $sRootPath
     */
    if (empty($aSettings['app']['website']['path'])) {
        throw Exception\RuntimeException('Website\'s path is missing in settings.');
    } else {
        $sRootPath = $aSettings['app']['website']['path'];
    }

    /**
     * Set the cache file for the routes. Note that you have to delete this file
     * whenever you change the routes.
     */
    $pApplication->getRouteCollector()->setCacheFile(\PBR_PATH . \DIRECTORY_SEPARATOR . 'tmp' . \DIRECTORY_SEPARATOR . 'routes.cache');

    // home
    $pApplication->get($sRootPath, function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, $args) {
        $response->getBody()->write("Hello world!");
        //$a = 1 / 0;
        //trigger_error("notice triggered", E_USER_NOTICE);
        //trigger_error("error triggered", E_USER_ERROR);
        return $response;
    });
};
