<?php

declare(strict_types=1);

/**
 * @package PbraidersTest\Pomponne\Application\Init
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace PbraidersTest\Pomponne\Application\Init;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Application\Init\AbstractStage;
use Slim\App;

/**
 * Do nothing test class.
 */
class DoNothingStage extends AbstractStage
{
    /**
     * Do nothing.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory
     * @return \Slim\App|null
     */
    public function initialize(ContainerFactoryInterface $factory): ?App
    {
        return parent::initialize($factory);
    }
}
