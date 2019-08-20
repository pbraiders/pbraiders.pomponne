<?php

declare(strict_types=1);

/**
 * Loads the application environment.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// Defines the root path.
define('PBR_PATH', __DIR__);

// Includes the Composer autoloader
require 'vendor/autoload.php';

// Loads all the needed services.
$pContainer = new League\Container\Container();
$pContainer
    ->addServiceProvider(new \Pbraiders\Config\ServiceProvider())
    ->addServiceProvider(new \Pbraiders\Application\ServiceProvider())
    ->addServiceProvider(new \Pbraiders\Logger\ServiceProvider());

// Get the config
$aConfig = $pContainer->get('config');

// Configures PHP
if (!empty($aConfig['php'])) {
    $pContainer->get('application')->configurePHP($aConfig['php']);
}

// Activates Whoops
if ((!empty($aConfig['modules']['application']['use_whoops']))) {
    $pContainer->get('whoops')->register();
}

// Configures the logger
$pContainer->get('logger')->info('hello');

// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
