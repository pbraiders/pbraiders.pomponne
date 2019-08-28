<?php

declare(strict_types=1);

/**
 * Define app middleware.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App;

use Slim\App;
use Pbraiders\Middleware\Exception;

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

    /*
     * Add Routing Middleware
     *
     * The routing middleware should be added earlier than the ErrorMiddleware
     * Otherwise exceptions thrown from it will not be handled by the middleware
     */
    $pApplication->addRoutingMiddleware();

    /*
     * Activates Error Handling Middleware. Only in production environment.
     * The warning and notice error are not catched.
     *
     * @param bool $displayErrorDetails -> Should be set to false in production
     * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
     * @param bool $logErrorDetails -> Display error details in error log
     * which can be replaced by a callable of your choice.
     *
     * Note: This middleware should be added last. It will not handle any exceptions/errors
     * for middleware added after it.
     */
    if ((empty($aSettings['module']['error']['use_whoops']))) {
        $pApplication->addErrorMiddleware(false, true, true);
    }
};
