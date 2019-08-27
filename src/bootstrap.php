<?php

declare(strict_types=1);

/**
 * Loads and configures the application environment.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// Includes the Composer autoloader
require \PBR_PATH . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php';

/**
 * Creates the container and loads all the needed services.
 *
 * In order to use the dependency injection pattern.
 *
 * @var Psr\Container\ContainerInterface $pContainer
 */
$pContainer = \Pbraiders\Service\Container\Factory::createFromInvokables(
    [
        // Add the services provider.
        \Pbraiders\Service\ServiceProvider::class,
        // Add the database handler () as service.
        // Add middlewares
        // -- ...
        // -- authentication
        // -- csrf
        // -- session
        // -- Routing middleware
        // -- Error Handling Middleware
        // Add routes
    ]
);

/**
 * Loads the settings.
 *
 * In order to configure many things before the app runs.
 *
 * @var array $aSettings
 */
$aSettings = $pContainer->get('settings');

/**
 * Configures PHP.
 *
 * We modify the configuration options using the ini_set php command.
 * These options will keep there new values during the script's execution,
 * and will be restored at the script's ending.
 */
if (!empty($aSettings['php'])) {
    $pContainer->get(\Pbraiders\Service\Utils\Stdlib::class)->configurePHP($aSettings['php']);
}

/**
 * In debug mode / development environment we activate Whoops globally, not as a middleware.
 *
 * Whoops is an error handler framework for PHP.
 * Out-of-the-box, it provides a pretty error interface that helps you debug your web projects,
 * but at heart it's a simple yet powerful stacked error handling system.
 */
if ((!empty($aSettings['module']['error']['use_whoops']))) {
    $pContainer->get('whoops')->register();
}

/**
 * Instantiate App
 *
 * In order for the app to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 *
 * @var Slim\App $pApplication
 */
$pApplication = $pContainer->get(\Slim\App::class);

/**
 * Set the cache file for the routes. Note that you have to delete this file
 * whenever you change the routes.
 */
/*$pApplication->getRouteCollector()->setCacheFile(
    $\PBR_PATH . \DIRECTORY_SEPARATOR . 'tmp' . \DIRECTORY_SEPARATOR . 'routes.cache';
);*/

/**
 * Add Middlewares
 */


/*
* Add Routing Middleware
*
* The routing middleware should be added earlier than the ErrorMiddleware
* Otherwise exceptions thrown from it will not be handled by the middleware
*/
$pApplication->addRoutingMiddleware();

/*
* Activates Error Handling Middleware. Only in production environment.
. The warning and notice error are not catched.
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

// Define app routes
$pApplication->get($aSettings['website']['path'], function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, $args) {
    $response->getBody()->write("Hello world!");
    //$a = 1 / 0;
    //trigger_error("notice triggered", E_USER_NOTICE);
    //trigger_error("error triggered", E_USER_ERROR);
    return $response;
});

// Run app
$pApplication->run();

// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
