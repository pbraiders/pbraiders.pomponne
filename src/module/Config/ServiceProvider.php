<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

use League\Container\ServiceProvider\AbstractServiceProvider;

class ServiceProvider extends AbstractServiceProvider {

    /**
     * Main config filename.
     *
     * @var string
     */
    protected $sConfigFileMain = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'config.php';

    /**
     * Local config filename
     *
     * @var string
     */
    protected $sConfigFileLocal = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'local.config.php';

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
        'config'
    ];

    /**
     * Sets the main config filename
     *
     * @param string $filename
     * @return ServiceProvider
     */
    public function setMainConfigFilename(string $filename): ServiceProvider
    {
        $this->sConfigFileMain = $filename;
        return $this;
    }

    /**
     * Sets the local config filename
     *
     * @param string $filename
     * @return ServiceProvider
     */
    public function setLocalConfigFilename(string $filename): ServiceProvider
    {
        $this->sConfigFileLocal = $filename;
        return $this;
    }

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

        // File must exists
        if (!is_readable($this->sConfigFileMain)) {
            throw new Exception\RuntimeException(sprintf('The config file "%s" cannot be found.', $this->sConfigFileMain));
        }

        // Reads the main config file
        $aConfig = require $this->sConfigFileMain;

        // Reads the local config file
        if (is_readable($this->sConfigFileLocal)) {
            $aConfig = array_replace_recursive($aConfig, require $this->sConfigFileLocal);
        }

        // Register
        $this->getContainer()->share('config',$aConfig);

    }
};
