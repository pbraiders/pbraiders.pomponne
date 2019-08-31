<?php

declare(strict_types=1);

/**
 * Provides error handler as a service.
 *
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Service\ErrorHandler
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\ErrorHandler;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
use Pbraiders\Service\Exception;

/**
 * Provides error handler as a service.
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
        'errorhandler',
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
        $pContainer = $this->getContainer();

        $pContainer->share('errorhandler', Run::class);

        $pContainer
            ->inflector(Run::class)
            ->invokeMethod('prependHandler', [new PrettyPageHandler()]);
    }
}
