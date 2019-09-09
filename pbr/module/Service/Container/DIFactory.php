<?php

declare(strict_types=1);

/**
 * Container factory.
 *
 * Creates and populates a Psr\Container with invokables or factories.
 *
 * @package Pbraiders\Service\Container
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Container;

use League\Container\Container;
use Psr\Container\ContainerInterface;

class Factory
{
    /**
     * Creates and initializes the PSR container with service providers.
     *
     * @param array $providers Array of class name. The class name should be class that may be directly instantiated
     * without any constructor arguments.
     * @return ContainerInterface
     */
    public static function createFromInvokables(array $providers): ContainerInterface
    {
        $pContainer = new Container();

        // register the reflection container as a delegate to enable auto wiring
        //        $pContainer->delegate(
        //            (new \League\Container\ReflectionContainer)->cacheResolutions()
        //        );

        foreach ($providers as $provider) {
            $pContainer->addServiceProvider(new $provider);
        }
        return $pContainer;
    }

    /**
     * Creates and initializes the PSR container with factories.
     *
     * @param array $factories an array of service name/factory class name pairs. The factories should be any PHP
     * callbacks.
     * @return ContainerInterface
     */
    public static function createFromFactories(array $factories): ContainerInterface
    {
        $pContainer = new Container();

        // register the reflection container as a delegate to enable auto wiring
        //        $pContainer->delegate(
        //            (new \League\Container\ReflectionContainer)->cacheResolutions()
        //        );

        foreach ($factories as $sServiceName => $sFactory) {
            $pContainer->share($sServiceName, $sFactory)->addArgument($pContainer);
        }
        return $pContainer;
    }
}
