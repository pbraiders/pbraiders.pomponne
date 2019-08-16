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
        // Retrieves the configuration
        $aConfig = $this->getConfig();

        // Register the handlers
        $this->getContainer()
            ->share('logger.handler.stream',\Monolog\Handler\StreamHandler::class)
            ->addArgument( $aConfig['error_log'] )
            ->addArgument( 100 );

        // Register the logger
        $this->getContainer()->share('logger',\Monolog\Logger::class)->addArgument('pbraiders');

        // Initialize the logger the first time is instanciated
        $this->getContainer()
            ->inflector(\Monolog\Logger::class)
            ->invokeMethod('pushHandler', [$this->getContainer()->get('logger.handler.stream')]);
    }

    /**
     * Retrieves and filters the logger configuration.
     *
     * @return array
     */
    protected function getConfig(): array
    {
        echo '<pre>' . __METHOD__ . '</pre>', PHP_EOL;

        // Retrieves the logger configuration.
        $aConfig = $this->getContainer()->get('config');

        if( empty($aConfig['modules']['logger']) ) {
            throw new Exception\RuntimeException('Logger configuration is missing.');
        }

        // Filter the logger configuration.
        $aFilter = [ 'error_log' => true ];
        $aConfig = array_intersect_key($aConfig['modules']['logger'], $aFilter );

        if( count($aConfig) != count($aFilter) ) {
            throw new Exception\RuntimeException('Logger configuration is not valid.');
        }

        return $aConfig;
    }

};
