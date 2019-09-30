<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Initializer
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception;
use Pbraiders\Pomponne\Service\Config\Factory as ConfigFactory;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactory;
use Pbraiders\Pomponne\Service\ErrorHandler\Factory as ErrorHandlerFactory;

use function Pbraiders\Stdlib\configurePHP;
use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Main application init strategy.
 */
class Main extends Initializer
{

    /**
     * Quick and easy initialization of the Application.
     * - Set working dir.
     * - Load configurations.
     * - Configures PHP.
     * - Configure the debug error handler if needed.
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
         * Configures PHP.
         *
         * We modify the configuration options using the ini_set php command.
         * These options will keep there new values during the script's execution,
         * and will be restored at the script's ending.
         */
        if (count($aSettings['php']) > 0) {
            configurePHP($aSettings['php']);
        }

        /**
         * In debug mode / development environment we activate Whoops globally, not as a middleware.
         *
         * Whoops is an error handler framework for PHP.
         * Out-of-the-box, it provides a pretty error interface that helps you debug your web projects,
         * but at heart it's a simple yet powerful stacked error handling system.
         *
         * @var mixed $bUseWhoops Boolean is required.
         */
        $bUseWhoops = extractDepthKeyInArray($aSettings, ['service' => ['error' => ['use_whoops' => true]]]);
        if (true === $bUseWhoops) {
            (new ErrorHandlerFactory())->create()->register();
        }

        /**
         * Creates the container factory from the settings.
         */
        $pContainerFactory = (new ContainerFactory())->create($aSettings);
        $pContainerFactory->registerDefinition('settings', ['settings' => $aSettings], true);

        return new Application($pContainerFactory);
    }
}
