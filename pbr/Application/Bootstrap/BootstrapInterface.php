<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface;

/**
 * Interface for bootstrap strategies.
 */
interface BootstrapInterface
{

    /**
     * Container factory setter.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory The PSR-11 container factory.
     * @return BootstrapInterface
     */
    public function setContainerFactory(FactoryInterface $factory): BootstrapInterface;

    /**
     * Bootstraps.
     *
     * @return void
     */
    public function bootstrap(): void;
}
