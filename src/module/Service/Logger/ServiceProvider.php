<?php

declare(strict_types=1);

/**
 * Provides logger as a service.
 *
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Service\Logger
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Logger;

use Psr\Log\LoggerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Pbraiders\Service\Exception;
use Pbraiders\Service\Logger\LineFormatter;
use Pbraiders\Service\Logger\StreamHandler;

/**
 * Provides logger as a service.
 */
class ServiceProvider extends AbstractServiceProvider
{

    /**
     * The provided array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        LoggerInterface::class,
        StreamHandler::class,
        LineFormatter::class,
        WebProcessor::class,
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     *
     * @throws Exception\RuntimeException Setting is missing.
     * @throws \League\Container\Exception\ContainerException
     * @throws \League\Container\Exception\NotFoundException
     * @return void
     */
    public function register(): void
    {
        // Retrieves the container.

        /** @var \League\Container\Container $pContainer */
        $pContainer = $this->getContainer();

        // Retrieves the configuration.
        $aSettings = $pContainer->get('settings');

        if (empty($aSettings['service']['logger'])) {
            throw new Exception\RuntimeException('Logger configuration is missing.');
        }

        $aSettings = &$aSettings['service']['logger'];

        // Registers the processor.
        $pContainer
            ->add(WebProcessor::class);

        // Registers the formater.
        $pContainer
            ->add(LineFormatter::class);

        // Registers and the Initializes the handler with formatter the first time is instanciated.
        $pContainer
            ->add(StreamHandler::class)
            ->addArgument($aSettings)
            ->addMethodCall('setFormatter', [$pContainer->get(LineFormatter::class)]);

        // Registers and Initializes the logger with handler and processor the first time is instanciated.
        $pContainer
            ->share(LoggerInterface::class, Logger::class)
            ->addArgument('pbraiders')
            ->addMethodCall('pushHandler', [$pContainer->get(StreamHandler::class)])
            ->addMethodCall('pushProcessor', [$pContainer->get(WebProcessor::class)]);
    }
}
