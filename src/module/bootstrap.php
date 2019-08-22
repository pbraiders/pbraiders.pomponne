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

// Creates the container and loads all the needed services.
$pContainer = \Pbraiders\Container\ContainerFactory::createInvokables(
    [
        '\Pbraiders\Config\ServiceProvider',
        '\Pbraiders\Application\ServiceProvider',
        '\Pbraiders\Logger\ServiceProvider',
    ]
);

// Get the config
$aConfig = $pContainer->get('settings');
/*echo '<pre>', PHP_EOL;
var_dump($aConfig);
echo '</pre>', PHP_EOL;*/

// Configures PHP
if (!empty($aConfig['php'])) {
    $pContainer->get(\Pbraiders\Application\Application::class)->configurePHP($aConfig['php']);
}

// Activates Whoops
if ((!empty($aConfig['modules']['application']['use_whoops']))) {
    $pContainer->get('whoops')->register();
}

// Register the logger
$pContainer->get('logger');

// Set container to create App with on AppFactory
\Slim\Factory\AppFactory::setContainer($pContainer);

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */
$pApplication = \Slim\Factory\AppFactory::create();

/*
 * Add Routing Middleware
 *
 * The routing middleware should be added earlier than the ErrorMiddleware
 * Otherwise exceptions thrown from it will not be handled by the middleware
 */
$pApplication->addRoutingMiddleware();

/*
 * Activates Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.
 *
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
if ((empty($aConfig['modules']['application']['use_whoops']))) {
    $pApplication->addErrorMiddleware(false, true, true);
}

// Define app routes
$pApplication->get('/v2.0.0/', function (\Psr\Http\Message\ServerRequestInterface $request, \Psr\Http\Message\ResponseInterface $response, $args) {
    $response->getBody()->write("Hello world!");
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
