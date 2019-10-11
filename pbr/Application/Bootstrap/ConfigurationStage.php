<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;
use Pbraiders\Pomponne\Service\Config\Factory as ConfigFactory;

/**
 * Loads the settings from the configuration files.
 *
 * We use the config factory helper to loads and merges the configuration files.
 */
class ConfigurationStage extends AbstractStage
{

    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @throws \Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException If the working directory can not be defined.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If the directory does not exist or is not writable.
     * @throws \Pbraiders\Config\Exception\FileDoNotExistNorReadableException If a file does not exist or is not readable.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        /**
         * Defines the working directory.
         *
         * We keep the actual working directory.
         * This method works well in production and development environment.
         */
        $sWorkingDir = $settings['application']['working_directory'] ?? getcwd();
        if (! is_string($sWorkingDir) || (strlen($sWorkingDir) == 0)) {
            throw new InvalidWorkingDirectoryException("The working directory is not defined.");
        }

        // Loads the configuration.
        $aSettings = (new ConfigFactory())->create($sWorkingDir);

        return parent::boot($aSettings);
    }
}
