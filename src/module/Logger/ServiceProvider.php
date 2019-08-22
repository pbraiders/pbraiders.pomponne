<?php

declare(strict_types=1);

/**
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Logger
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Logger;

use Psr\Log\LoggerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Pbraiders\Logger\{LineFormatter, StreamHandler};

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
     * @throws Exception\RuntimeException If the configuration is not valid.
     * @return void
     */
    public function register(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        // Retrieves the configuration.
        $aConfig = $pContainer->get('settings');

        if (empty($aConfig['modules']['logger'])) {
            throw new Exception\RuntimeException('Logger configuration is missing.');
        }

        $aConfig = &$aConfig['modules']['logger'];

        // Registers the processor.
        $pContainer
            ->add(WebProcessor::class);

        // Registers the formater.
        $pContainer
            ->add(LineFormatter::class);

        // Registers the handler.
        $pContainer
            ->add(StreamHandler::class)
            ->addArgument($aConfig);

        // Initializes the handler with formatter the first time is instanciated.
        $pContainer
            ->inflector(\Monolog\Handler\StreamHandler::class)
            ->invokeMethod('setFormatter', [$pContainer->get(LineFormatter::class)]);

        // Registers the logger.
        $pContainer->share(LoggerInterface::class, Logger::class)->addArgument('pbraiders');

        // Initializes the logger with handler and processor the first time is instanciated.
        $pContainer
            ->inflector(Logger::class)
            ->invokeMethod('pushHandler', [$pContainer->get(StreamHandler::class)]);

        $pContainer
            ->inflector(Logger::class)
            ->invokeMethod('pushProcessor', [$pContainer->get(WebProcessor::class)]);
    }
};
