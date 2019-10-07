<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;

use function Pbraiders\Stdlib\configurePHP;

/**
 * Configures PHP.
 *
 * We modify the configuration options using the ini_set php command.
 * These options will keep there new values during the script's execution,
 * and will be restored at the script's ending.
 */
class PHPStage extends AbstractStage
{
    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If a setting is missing.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        // Loads PHP settings only
        $aSettings = array_intersect_key($settings, ['php']);

        // Settings must exists
        if (! isset($aSettings['php']) || ! is_array($aSettings['php'])) {
            throw new MissingSettingException('The php settings are missing.');
        }

        // Configures
        if (count($aSettings['php']) > 0) {
            configurePHP($aSettings['php']);
        }

        return parent::boot($settings);
    }
}
