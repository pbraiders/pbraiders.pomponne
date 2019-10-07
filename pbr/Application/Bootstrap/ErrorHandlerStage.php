<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Bootstrap
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Bootstrap;

use Pbraiders\Container\FactoryInterface as ContainerFactoryInterface;
use Pbraiders\Pomponne\Service\ErrorHandler\Factory as ErrorHandlerFactory;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Configures the error handler.
 *
 * We use the error handler factory helper to loads and configures Whoops.
 * Whoops is an error handler framework for PHP.
 * Out-of-the-box, it provides a pretty error interface that helps you debug your web projects,
 * but at heart it's a simple yet powerful stacked error handling system.
 *
 * In debug mode / development environment we activate Whoops globally, not as a middleware.
 */
class ErrorHandlerStage extends AbstractStage
{

    /**
     * Loads, configures and then executes bootstrap stages.
     *
     * @param array $settings The settings.
     * @throws \InvalidArgumentException  If an error handler is not callable or not an instance of HandlerInterface.
     * @return \Pbraiders\Container\FactoryInterface|null
     */
    public function boot(array $settings): ?ContainerFactoryInterface
    {
        $bUseWhoops = extractDepthKeyInArray($settings, ['service' => ['error' => ['use_whoops' => true]]]);
        if (true === $bUseWhoops) {
            (new ErrorHandlerFactory())->create()->register();
        }

        return parent::boot($settings);
    }
}
