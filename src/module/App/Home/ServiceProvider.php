<?php

declare(strict_types=1);

/**
 * Mediators provider.
 *
 * Service providers give the benefit of organising your container definitions along with an increase in performance for
 * larger applications as definitions registered within a service provider are lazily registered at the point where a
 * service is retrieved.
 *
 * @package Pbraiders\App
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Home;

use League\Container\ServiceProvider\AbstractServiceProvider;
use Pbraiders\App\Home\Mediator as HomeMediator;
use \Pbraiders\App\Home\View as HomeView;

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
        HomeMediator::class,
        HomeView::class
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
        // Home
        $this->registerHome();
    }

    /**
     * Registers home routes.
     *
     * @return void
     */
    protected function registerHome(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        $pContainer
            ->add(HomeView::class);

        $pContainer
            ->add(HomeMediator::class)
            ->addArgument($pContainer);

        //        $pContainer
        //            ->inflector(HomeView::class)
        //            ->invokeMethod('setEngine', [$pContainer->get('templatingengine')]);

        $pContainer
            ->inflector(HomeMediator::class)
            ->invokeMethod('setView', [$pContainer->get(HomeView::class)]);
    }
}
