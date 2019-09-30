<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Run
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Run;

use Pbraiders\Container\FactoryInterface;

/**
 * Do nothing strategy.
 * Usefull for test.
 */
class DoNothing implements RunInterface
{

    /**
     * Container Factory Setter.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory The PSR-11 container factory
     * @return RunInterface
     */
    public function setContainerFactory(FactoryInterface $factory): RunInterface
    {
        return $this;
    }

    /**
     * Do nothing.
     *
     * @return void
     */
    public function run(): void
    {
        // Do nothing.
    }
}
