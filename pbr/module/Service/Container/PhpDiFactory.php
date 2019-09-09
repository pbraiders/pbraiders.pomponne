<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Service\Container
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Container;

use DI\ContainerBuilder;
use Pbraiders\Service\Exception;
use Psr\Container\ContainerInterface;

/**
 * PHP-DI container factory.
 * Creates and populates a Psr\Container with invokables or factories.
 */
class PhpDiFactory implements ContainerFactory
{
    /**
     * Creates and populates a Psr\Container with invokables or factories.
     *
     * @param array $settings
     * @return \Psr\Container\ContainerInterface
     */
    public function createContainer(array $settings): ContainerInterface
    {
        /** @var array $aSettings Filtered settings. */
        $aSettings = $this->filterSettings($settings);

        /** @var \DI\ContainerBuilder $pBuilder Helper to create and configure a Container. */
        $pBuilder = new ContainerBuilder();

        // Compile the container for optimum performances.
        if (! empty($$aSettings['enable_compilation'])) {
            $pBuilder->enableCompilation(__DIR__ . '/var/cache');
        }

        // Configure the proxy generation.
        $pBuilder->writeProxiesToFile(true, __DIR__ . '/tmp/proxies');

        /**
         * Creates the container and loads all the needed services.
         * In order to use the dependency injection pattern.
         *
         * @var \Psr\Container\ContainerInterface $pContainer
         */
        $pContainer = $pBuilder->build();

        return $pContainer;
    }

    /**
     * Filters the container settings.
     *
     * @param array $aSettings Settings
     * @throws Pbraiders\Service\Exception\InvalidArgumentException If settings are not valid.
     * @return array
     */
    protected function filterSettings(array $aSettings): array
    {
        /** @var array $aExpected Expected setting keys to be found. */
        $aExpected = [
            'enable_compilation' => true,
            'write_proxies_to_file' => false,
        ];

        // Retreives all all the entries of $aSettings which have keys that are present in $aExpected.
        $aActual = array_intersect_key($aSettings, $aExpected);

        if (count($aActual) !== count($aExpected)) {
            throw new Exception\InvalidArgumentException("Container settings are not valid.");
        }

        return $aActual;
    }
}
