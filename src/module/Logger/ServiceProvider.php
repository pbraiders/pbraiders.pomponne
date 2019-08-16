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

class ServiceProvider extends AbstractServiceProvider {

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
     * @return void
     */
    public function register(): void
    {
        // Retrieves the container.
        $pContainer = $this->getContainer();

        // Loads the configuration.
        $aConfig = $pContainer->get('config');
        if( !$pContainer->has('config') ){
            throw new \League\Container\Exception\NotFoundException('Configuration is missing.');
        }



        $this->getContainer()->share('logger',\Monolog\Logger::class)->addArgument('pbraiders');
        $this->getContainer()
            ->share('logger.handler.stream',\Monolog\Handler\StreamHandler::class)
            ->addArgument( \PBR_PATH . '/log/my_app.log')
            ->addArgument( 100 );
        $this->getContainer()
            ->inflector(\Monolog\Logger::class)
            ->invokeMethod('pushHandler', [$this->getContainer()->get('logger.handler.stream')]);
    }

};
