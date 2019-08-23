<?php

declare(strict_types=1);

/**
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Middleware;

use League\Container\ServiceProvider\AbstractServiceProvider;

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
        'settings'
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
        // Retrieves the container.
        /** @var Psr\Container\ContainerInterface $pContainer */
        $pContainer = $this->getContainer();

        // Retrieves the configuration.
        /** @var array $aSettings */
        $aSettings = $pContainer->get('settings');

        // Retrieve the PRS-7 app implementation
        /** @var Slim\App $pApplication */
        $pApplication = $pContainer->get(\Slim\App::class);
    }
};
