<?php

declare(strict_types=1);

/**
 * Define Home routes.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Home;

use Slim\App;
use Pbraiders\App\Exception;

/**
 * @param \Slim\App App $pApplication
 * @param string $sBasePath
 * @throws Exception\RuntimeException If settings is missing.
 */
return static function (App $pApplication, string $sBasePath) {

    /**
     * Initialize usefull variables.
     */

    $sBasePath = trim($sBasePath);

    if (empty($sBasePath)) {
        throw new Exception\RuntimeException('The base path setting is missing in the config file.');
    }

    /**
     * Defines the routes.
     */

    // home
    //$pApplication->get($sBasePath, 'Pbraiders\App\Home\Mediator:getAction');
};
