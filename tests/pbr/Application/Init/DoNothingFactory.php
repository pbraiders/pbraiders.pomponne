<?php

declare(strict_types=1);

/**
 * @package PbraidersTest\Pomponne\Application\Init
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace PbraidersTest\Pomponne\Application\Init;

use DI\Container;
use Pbraiders\Container\FactoryInterface;
use Psr\Container\ContainerInterface;

/**
 * Do nothing test class.
 */
class DoNothingFactory implements FactoryInterface
{
    /**
     * Creates, configures and populates a PSR-11 dependency injection container factory.
     *
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(): ContainerInterface
    {
        return new Container();
    }

    /**
     * Do Nothing
     *
     * @param string $id Definition iD
     * @param array $definitions The definitions.
     * @param boolean $shared We can tell a definition to only resolve once and return the same instance every time it is resolved.
     * @param boolean $serviceprovider If the definition is a service provider.
     * @return void
     */
    public function registerDefinition(string $id, array $definitions, bool $shared = false, bool $serviceprovider = false): void
    {
        // Do nothing
    }
}
