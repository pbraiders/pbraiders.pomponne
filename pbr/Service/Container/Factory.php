<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Container
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Container;

use Pbraiders\Container\FactoryInterface;
use Pbraiders\Container\PhpDiFactory;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Container factory factory.
 * We use PHP-DI container factory
 */
final class Factory
{

    /**
     * Creates and initializes the container factory.
     *
     * @param array $settings
     * @throws MissingSettingException If setting is missing.
     * @throws \InvalidArgumentException if the definition registrement is not valid.
     * @return \Pbraiders\Container\FactoryInterface
     */
    public function create(array $settings): FactoryInterface
    {
        /**
         * Retrieves the values we need.
         */

        /** @var array $aFilter Settings filter*/
        $aFilter = [
            'application' => [
                'cache_path' => true
            ],
            'service' => [
                'container' => true
            ]
        ];

        /** @var array $aSettings Filtered settings*/
        $aSettings = \array_intersect_key($settings, $aFilter);

        /** @var string|null $sCacheDirectory */
        $sCacheDirectory = extractDepthKeyInArray($aSettings, ['application' => ['cache_path' => true]]);
        if (is_null($sCacheDirectory)) {
            throw new MissingSettingException('The application.cache_path setting is missing in the config file.');
        }

        /** @var boolean|null $bCompilationEnabled */
        $bCompilationEnabled = extractDepthKeyInArray($aSettings, ['service' => ['container' => ['enable_compilation' => true]]]);
        if (is_null($bCompilationEnabled)) {
            throw new MissingSettingException('The service.container.enable_compilation setting is missing in the config file.');
        }

        /** @var boolean|null $bProxyEnabled */
        $bProxyEnabled = extractDepthKeyInArray($aSettings, ['service' => ['container' => ['write_proxies_to_file' => true]]]);
        if (is_null($bProxyEnabled)) {
            throw new MissingSettingException('The service.container.write_proxies_to_file setting is missing in the config file.');
        }

        /**
         * Creates and starts initializing the container factory.
         */

        $pFactory = new PhpDiFactory();
        $pFactory
            ->setCacheDirectory($sCacheDirectory)
            ->setProxyDirectory($sCacheDirectory . DIRECTORY_SEPARATOR . 'proxies');
        if (!$bCompilationEnabled) {
            $pFactory->disableCompilation();
        }
        if (!$bProxyEnabled) {
            $pFactory->disableProxy();
        }

        return $pFactory;
    }
}
