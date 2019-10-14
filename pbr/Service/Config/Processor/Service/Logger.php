<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor\Service
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor\Service;

use Pbraiders\Config\Processor\Processor;
use Pbraiders\Pomponne\Service\Config\Exception;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Updates logger path according to the working directory
 */
class Logger extends Processor
{

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely an array
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If settings is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If settings is not valid.
     * @throws \InvalidArgumentException If URl is not valid.
     * @return mixed Returns the modified config.
     */
    public function process($settings)
    {
        /**
         * Filters the settings.
         *
         * @var mixed|null $sWorkingDir The working directory.
         */
        $sWorkingDir = extractDepthKeyInArray($settings, ['application' => ['working_directory' => true]]);
        if (! is_string($sWorkingDir)) {
            throw new Exception\MissingSettingException('The application.working_directory setting is missing.');
        }
        $sWorkingDir = trim($sWorkingDir);

        /** @var mixed|null $sFormat The format. */
        $sFormat = extractDepthKeyInArray($settings, ['service' => ['logger' => ['error_log' => true]]]);
        if (! is_string($sFormat)) {
            throw new Exception\MissingSettingException('The service.logger.error_log setting is missing.');
        }
        $sFormat = trim($sFormat);
        if (strlen($sFormat) == 0) {
            throw new Exception\InvalidSettingException('The service.logger.error_log setting is not valid.');
        }

        /**
         * Updates.
         */
        $settings['service']['logger']['error_log'] = sprintf($sFormat, $sWorkingDir);

        // Next
        return parent::process($settings);
    }
}
