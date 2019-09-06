<?php

declare(strict_types=1);

/**
 * Mediators provider.
 *
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\App\Debug
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Debug;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Pbraiders\App\Debug\Mediator;
use Pbraiders\App\Debug\View;

/**
 * Mediators provider.
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
        Mediator::class,
        View::class
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     *
     * @throws \League\Container\Exception\ContainerException Error while retrieving the entry.
     * @throws \League\Container\Exception\NotFoundException No entry was found for **this** identifier.
     * @return void
     */
    public function register(): void
    {
        $this->registerView();
        $this->registerMediator();
    }

    /**
     * Registers the mediator.
     *
     * @throws \League\Container\Exception\ContainerException Error while retrieving the entry.
     * @throws \League\Container\Exception\NotFoundException No entry was found for **this** identifier.
     * @return void
     */
    protected function registerMediator(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        $pContainer
            ->add(Mediator::class)
            ->addArgument($pContainer)
            ->addMethodCall('setView', [$pContainer->get(View::class)]);
    }

    /**
     * Registers the view.
     *
     * @throws \League\Container\Exception\ContainerException Error while retrieving the entry.
     * @throws \League\Container\Exception\NotFoundException No entry was found for **this** identifier.
     * @return void
     */
    protected function registerView(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        $pContainer
            ->add(View::class);
        //->addArgument($pContainer->get('templatingengine'));
    }
}
