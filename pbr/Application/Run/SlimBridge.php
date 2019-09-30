<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Run
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Run;

use Pbraiders\Container\FactoryInterface;

/**
 * Run strategy.
 * Use Slim Bridge
 */
class SlimBridge implements RunInterface
{

    /**
     * The PSR-11 container factory.
     *
     * @var \Pbraiders\Container\FactoryInterface
     */
    protected $pContainerFactory;

    /**
     * Container Factory Setter.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory The PSR-11 container factory
     * @return RunInterface
     */
    public function setContainerFactory(FactoryInterface $factory): RunInterface
    {
        $this->pContainerFactory = $factory;
        return $this;
    }

    /**
     * Runs the App.
     *
     * @throws \Pbraiders\Container\Exception\ProxyDirectoryNotExistNorWritableException If proxy directory does not exist or is not writable.
     * @throws \Pbraiders\Container\Exception\CacheDirectoryNotExistNorWritableException If cache directory does not exist or is not writable.
     * @throws \InvalidArgumentException when the proxy directory is null.
     * @return void
     */
    public function run(): void
    {
        /**
         * Creates the container and loads all the needed services.
         * In order to use the dependency injection pattern.
         */
        $pContainer = $this->pContainerFactory->createContainer();

        /**
         * Instantiate the app
         *
         * In order for the app to work you need to ensure you have installed
         * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
         * ServerRequest creator (included with Slim PSR-7)
         */
        $pApplication = \DI\Bridge\Slim\Bridge::create($pContainer);

        /**
         * Add middlewares.
         */

        /**
         * Add routes
         */

        $pApplication->run();
    }
}
