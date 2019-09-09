<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Service\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Config;

/**
 * Config factory interface.
 */
interface FactoryInterface
{
    /**
     * Creates a config array or object implementing ArrayAccess.
     *
     * @return array|ArrayAccess
     */
    public function createConfig(array $settings);
}
