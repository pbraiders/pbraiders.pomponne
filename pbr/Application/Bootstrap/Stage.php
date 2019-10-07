<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;

/**
 * The Stage interface declares a method for building the chain of stages.
 * It also declares a method for booting the application.
 */
interface Stage
{
    /**
     * Stage setter.
     *
     * @param Stage $stage
     * @return Stage
     */
    public function setNext(Stage $stage): Stage;

    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @throws \InvalidArgumentException  If an error handler is not callable or not an instance of HandlerInterface.
     * @throws \InvalidArgumentException if a container definition is not valid.
     * @throws \Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException If the working directory can not be defined.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If the directory does not exist or is not writable.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If a setting is missing.
     * @throws \Pbraiders\Config\Exception\FileDoNotExistNorReadableException If a file does not exist or is not readable.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface;
}
