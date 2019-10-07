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

use function DI\factory;
use function DI\get;

/**
 * Registers the logger.
 * Adds dependencies/definitions to the container factory.
 */
class RegisterLoggerStage extends AbstractStage
{
    /**
     * Initializes stages.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory
     * @return \Slim\App|null
     */
    public function initialize(ContainerFactoryInterface $factory): ?App
    {
        $factory->registerDefinition(
            \Psr\Log\LoggerInterface::class,
            [
                \Psr\Log\LoggerInterface::class => factory('\Pbraiders\Pomponne\Service\Logger\Factory::create')
                    ->parameter('settings', get('settings')),
            ],
            true
        );

        return parent::initialize($factory);
    }
}
