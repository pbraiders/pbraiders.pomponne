<?php

declare(strict_types=1);

/**
 * Settings as service.
 *
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Service
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service;

use Psr\Log\LoggerInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Slim\App;
use Slim\Factory\AppFactory;
use Pbraiders\Service\Exception;
use Pbraiders\Service\Config\Factory as ConfigFactory;
use Pbraiders\Service\Logger\LineFormatter;
use Pbraiders\Service\Logger\StreamHandler;
use Pbraiders\Service\Utils\Stdlib;

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
        'settings',
        Stdlib::class,
        App::class,
        'whoops',
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
     * @throws Exception\RuntimeException
     * @return void
     */
    public function register(): void
    {
        $this->registerSettings();
        $this->registerStdlib();
        $this->registerErrorHandler();
        $this->registerFramework();
        $this->registerLogger();
    }

    /**
     * Registeres settings
     *
     * @return void
     */
    protected function registerSettings(): void
    {
        $pFactory = new ConfigFactory();
        $this->getContainer()->share('settings', $pFactory->create());
        unset($pFactory);
    }

    /**
     * Register Logger
     *
     * @return void
     */
    public function registerLogger(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        // Retrieves the configuration.
        $aSettings = $pContainer->get('settings');

        if (empty($aSettings['modules']['logger'])) {
            throw new Exception\RuntimeException('Logger configuration is missing.');
        }

        $aSettings = &$aSettings['modules']['logger'];

        // Registers the processor.
        $pContainer
            ->add(WebProcessor::class);

        // Registers the formater.
        $pContainer
            ->add(LineFormatter::class);

        // Registers the handler.
        $pContainer
            ->add(StreamHandler::class)
            ->addArgument($aSettings);

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

    /**
     * Registers utilities
     *
     * @return void
     */
    protected function registerStdlib(): void
    {
        $this->getContainer()->share(Stdlib::class);
    }

    /**
     * Registers error handler
     *
     * @return void
     */
    protected function registerErrorHandler(): void
    {
        $pContainer = $this->getContainer();

        $pContainer->share('whoops', Run::class);

        $pContainer
            ->inflector(Run::class)
            ->invokeMethod('prependHandler', [new PrettyPageHandler()]);
    }

    /**
     * Register the PSR-7 Middleware Microframework
     *
     * In order for the factory to work you need to ensure you have installed
     * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
     * ServerRequest creator (included with Slim PSR-7)
     *
     * @return void
     */
    protected function registerFramework(): void
    {
        $pContainer = $this->getContainer();
        $pContainer->share(App::class, AppFactory::create(\null, $pContainer, \null, \null, \null));
    }
};
