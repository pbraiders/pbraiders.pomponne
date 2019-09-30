<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Init
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception;
use Pbraiders\Pomponne\Service\Config\Factory as ConfigFactory;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactory;

/**
 * Simple strategy.
 */
class Simple extends Initializer
{

    /**
     * Static method for quick and easy initialization of the Application.
     * - Set working dir.
     * - Load configurations.
     *
     * @throws \Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException If the working directory argument is not valid.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If the working directory is not valid or not writable.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If a setting is missing.
     * @throws \Pbraiders\Config\Exception\FileDoNotExistNorReadableException If the config file does not exist.
     * @throws \InvalidArgumentException if the definition registrement is not valid.
     * @return \Pbraiders\Pomponne\Application\Application
     */
    public function initialize(): Application
    {
        /**
         * Defines the working directory.
         *
         * We keep the actual working directory.
         * This method works well in production and development environment.
         */
        if (is_null($this->sWorkingDir)) {
            $this->sWorkingDir = getcwd();
        }
        if ((false === $this->sWorkingDir) || (strlen($this->sWorkingDir) == 0)) {
            throw new Exception\InvalidWorkingDirectoryException("The working directory is not defined.");
        }

        /**
         * Loads the settings from the configuration files.
         *
         * We use the config factory helper to loads and merges the configuration files.
         *
         * @var array $aSetting Settings.
         */
        $aSettings = (new ConfigFactory())->create($this->sWorkingDir);

        /**
         * Creates the container factory from the settings.
         */
        $pContainerFactory = (new ContainerFactory())->create($aSettings);
        $pContainerFactory->registerDefinition('settings', ['settings' => $aSettings], true);

        return new Application($pContainerFactory);
    }
}
