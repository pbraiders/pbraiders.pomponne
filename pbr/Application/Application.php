<?php

declare(strict_types=1);
/**
 * @package Pbraiders\Pomponne\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application;

use Pbraiders\Pomponne\Application\Bootstrap\ConfigurationStage;
use Pbraiders\Pomponne\Application\Bootstrap\ContainerFactoryStage;
use Pbraiders\Pomponne\Application\Bootstrap\ErrorHandlerStage;
use Pbraiders\Pomponne\Application\Bootstrap\PHPStage;
use Pbraiders\Pomponne\Application\Init\RegisterLoggerStage;
use Pbraiders\Pomponne\Application\Init\SlimBridgeStage;
use Slim\App;

/**
 * Pomponne
 */
final class Application
{

    /**
     * Static method for quick and easy bootstrap and initialization of the Application.
     *
     * - Set working directory.
     * - Load settings from configurations files.
     * - Configures PHP.
     * - Configures the debug error handler if needed.
     * - Creates the container factory.
     *
     * @param array $config May contains some forced setting values like the working dir.
     * @return \Slim\App
     */
    public static function init(array $config): App
    {

        /** Quick and easy application bootstrap.
         * - Set working directory.
         * - Load settings from configurations files.
         * - Configures PHP.
         * - Configures the debug error handler if needed.
         * - Creates the container factory.
         *
         * @var \Pbraiders\Pomponne\Application\Bootstrap\Stage $pBootstrap
         */
        $pBootstrap = new ConfigurationStage();
        $pBootstrap
            ->setNext(new PHPStage())
            ->setNext(new ErrorHandlerStage())
            ->setNext(new ContainerFactoryStage());

        /**
         * @var \Pbraiders\Container\FactoryInterface $pContainerFactory
         */
        $pContainerFactory = $pBootstrap->boot($config);
        unset($pBootstrap);

        /**
         * Quick and easy application initialization.
         * - Registers definitions
         * - Creates the Slim App
         *
         * @var \Pbraiders\Pomponne\Application\Init\Stage $pInitializer
         */
        $pInitializer = new RegisterLoggerStage();
        $pInitializer->setNext(new SlimBridgeStage());

        /**
         * @var \Slim\App $pApplication
         */
        $pApplication = $pInitializer->initialize($pContainerFactory);
        unset($pInitializer);

        /**
         * Add middlewares.
         */

        /**
         * Add routes
         */

        return $pApplication;
    }
}

// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
