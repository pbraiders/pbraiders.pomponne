<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Init
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Init;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Slim\App;
use Slim\Factory\AppFactory;

/**
 * Creates and initializes the Slim app.
 * Use Slim Factory.
 */
class SlimStage extends AbstractStage
{

    /**
     * Creates and initializes the Slim app.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory
     * @return \Slim\App|null
     */
    public function initialize(ContainerFactoryInterface $factory): ?App
    {
        /**
         * Creates the container and loads all the needed services.
         * In order to use the dependency injection pattern.
         */
        $pContainer = $factory->createContainer();

        // Set container to create App with on AppFactory
        AppFactory::setContainer($pContainer);

        /**
         * Instantiates the app
         *
         * In order for the app to work you need to ensure you have installed
         * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
         * ServerRequest creator (included with Slim PSR-7)
         */
        return AppFactory::create();
    }
}
