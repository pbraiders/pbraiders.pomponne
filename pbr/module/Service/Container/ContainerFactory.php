<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Service\Container
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Container;

use Psr\Container\ContainerInterface;

/**
 * Simple container factory interface.
 */
interface ContainerFactory
{
    public function createContainer(): ContainerInterface;
}
