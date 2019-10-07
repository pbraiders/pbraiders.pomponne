<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Init
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Init;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Slim\App;

/**
 * The Stage interface declares a method for building the chain of stages.
 * It also declares a method for initializing the application.
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
     * Initializes stages.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory
     * @return \Slim\App|null
     */
    public function initialize(ContainerFactoryInterface $factory): ?App;
}
