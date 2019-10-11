<?php

declare(strict_types=1);

/**
 * @package PbraidersTest\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Application\Bootstrap\AbstractStage;

/**
 * Do nothing test class.
 */
class DoNothingStage extends AbstractStage
{

    /**
     * Current settings.
     *
     * @var array
     */
    public $aSettings = [];

    /**
     * Do nothing.
     *
     * @param array $settings The settings.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        $this->aSettings = $settings;
        return parent::boot($settings);
    }
}
