<?php

declare(strict_types=1);

/**
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Application;

use \League\Container\ServiceProvider\AbstractServiceProvider;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Slim\App;
use Slim\Factory\AppFactory;

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
        Stdlib::class,
        App::class,
        'whoops',
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerStdlib();
        $this->registerErrorHandler();
        $this->registerPSR7();
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
    protected function registerPSR7(): void
    {
        $pContainer = $this->getContainer();
        $pContainer->share(App::class, AppFactory::create(\null, $pContainer, \null, \null, \null));
    }
};
