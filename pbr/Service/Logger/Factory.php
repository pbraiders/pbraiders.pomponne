<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Logger;
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Logger;

use Monolog\Logger;
use Monolog\Processor\WebProcessor;
use Psr\Log\LoggerInterface;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Provides logger as a service.
 */
final class Factory
{

    /**
     * Creates and initializes the logger.
     *
     * @param array $settings
     * @throws \Pbraiders\Pomponne\Service\Logger\Exception\MissingSettingException If a setting is missing.
     * @throws \Pbraiders\Pomponne\Service\Logger\Exception\InvalidSettingException If a setting is not valid.
     * @throws \Exception if something bad happened.
     * @return \Psr\Log\LoggerInterface
     */
    public function create(array $settings): LoggerInterface
    {
        /**
         * Filters the logger configuration.
         */

        $aFilter = ['service' => ['logger' => true]];
        $aSettings = \array_intersect_key($settings, $aFilter);

        if (\count($aSettings) != \count($aFilter)) {
            throw new Exception\MissingSettingException('The service settings are missing.');
        }

        $aSettings = extractDepthKeyInArray($aSettings, $aFilter);
        if (is_null($aSettings)) {
            throw new Exception\MissingSettingException('The service.logger settings are missing.');
        }

        /**
         * Creates logger and handlers
         */

        $pHandler = new RotatingFileHandler($aSettings);
        $pHandler->setFormatter(new LineFormatter());
        $pLogger = new Logger('pbraiders.pomponne');
        $pLogger->pushHandler($pHandler)->pushProcessor(new WebProcessor());

        return $pLogger;
    }
}
