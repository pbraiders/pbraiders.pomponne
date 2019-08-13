<?php

declare(strict_types=1);

namespace Pbraiders\ServiceProvider;

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
        'Pbraiders\Config\Config'
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     */
    public function register()
    {
        // Retrieves the configuration
        $aConfig = require \PBR_PATH . '/config/config.php';
        if (is_readable(\PBR_PATH . '/config/local.config.php')) {
            $aConfig = array_replace_recursive($aConfig, require \PBR_PATH . '/config/local.config.php');
        }

        $this->getContainer()->add(Pbraiders\Config\Config::class)->addArgument($aConfig);
    }
}
