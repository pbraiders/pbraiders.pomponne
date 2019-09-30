<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface;

use function DI\factory;
use function DI\get;

/**
 * Definition register strategy.
 * Add dependencies/definitions to the container factory.
 */
class RegisterDefinition implements BootstrapInterface
{

    /**
     * The PSR-11 container factory.
     *
     * @var \Pbraiders\Container\FactoryInterface
     */
    protected $pContainerFactory;

    /**
     * Container Factory Setter.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory The PSR-11 container factory
     * @return BootstrapInterface
     */
    public function setContainerFactory(FactoryInterface $factory): BootstrapInterface
    {
        $this->pContainerFactory = $factory;
        return $this;
    }

    /**
     * Registers dependencies.
     *
     * @return void
     */
    public function bootstrap(): void
    {
        // Logger
        $this->pContainerFactory->registerDefinition(
            \Psr\Log\LoggerInterface::class,
            [
                \Psr\Log\LoggerInterface::class => factory('\Pbraiders\Pomponne\Service\Logger\Factory::create')
                    ->parameter('settings', get('settings')),
            ],
            true
        );
    }
}
