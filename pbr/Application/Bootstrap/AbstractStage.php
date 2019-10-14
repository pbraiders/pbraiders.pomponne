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
 * The default chaining behavior is implemented inside this base stage class.
 */
abstract class AbstractStage implements Stage
{
    /**
     * @var Stage
     */
    private $pNextStage;

    /**
     * Stage setter.
     *
     * @param Stage $stage
     * @return Stage
     */
    public function setNext(Stage $stage): Stage
    {
        $this->pNextStage = $stage;
        // Returning a stage from here will let us link stages in a
        // convenient way like this:
        // $monkey->setNext($squirrel)->setNext($dog);
        return $stage;
    }

    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        if (isset($this->pNextStage)) {
            return $this->pNextStage->boot($settings);
        }

        return null;
    }
}
