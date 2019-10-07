<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactoryFactory;

/**
 * Creates the PSR-11 container factory from the settings.
 * Creates the application.
 *
 * We use the PSR-11 container factory helper to configures and populates the PSR-11 container.
 */
class ContainerFactoryStage extends AbstractStage
{

    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @throws \InvalidArgumentException if a container definition is not valid.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If a setting is missing.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        $pContainerFactory = (new ContainerFactoryFactory())->create($settings);
        $pContainerFactory->registerDefinition('settings', ['settings' => $settings], true);

        return $pContainerFactory;
    }
}
