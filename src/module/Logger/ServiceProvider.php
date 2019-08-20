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

use \League\Container\ServiceProvider\AbstractServiceProvider;

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
        'logger',
        'logger.handler.stream',
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     *
     * @throws \Pbraiders\Logger\Exception\RuntimeException If the configuration is not valid.
     * @return void
     */
    public function register(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        // Retrieves the configuration.
        $aConfig = $pContainer->get('config');

        if (empty($aConfig['modules']['logger'])) {
            throw new Exception\RuntimeException('Logger configuration is missing.');
        }

        $aConfig = &$aConfig['modules']['logger'];

        // Registers the Formatter.
        $pContainer->share('logger.formater.line', \Pbraiders\Logger\LineFormatter::class);

        // Registers the processor.
        $pContainer->share('logger.processor.web', \Monolog\Processor\WebProcessor::class);

        // Registers the handler.
        $pContainer
            ->share('logger.handler.stream', \Pbraiders\Logger\StreamHandler::class)
            ->addArgument($aConfig);

        // Registers the logger.
        $pContainer->share('logger', \Monolog\Logger::class)->addArgument('pbraiders');

        // Initializes the handler with formatter the first time is instanciated.
        $pContainer
            ->inflector(\Pbraiders\Logger\StreamHandler::class)
            ->invokeMethod('setFormatter', [$pContainer->get('logger.formater.line')]);

        // Initializes the logger with handler and processor the first time is instanciated.
        $pContainer
            ->inflector(\Monolog\Logger::class)
            ->invokeMethod('pushHandler', [$pContainer->get('logger.handler.stream')]);
        $pContainer
            ->inflector(\Monolog\Logger::class)
            ->invokeMethod('pushProcessor', [$pContainer->get('logger.processor.web')]);
    }
};
