<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor\Application;

use Pbraiders\Config\Processor\Processor;
use Pbraiders\Pomponne\Service\Config\Exception;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Updates temporary path according to the working directory
 */
class TemporaryPath extends Processor
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
        $sFormat = extractDepthKeyInArray($settings, ['application' => ['temporary_path' => true]]);
        if (! is_string($sFormat)) {
            throw new Exception\MissingSettingException('The application.temporary_path setting is missing.');
        }
        $sFormat = trim($sFormat);
        if (strlen($sFormat) == 0) {
            throw new Exception\InvalidSettingException('The application.temporary_path setting is not valid.');
        }

        /**
         * Updates.
         */
        $settings['application']['temporary_path'] = sprintf($sFormat, $sWorkingDir);

        // Next
        return parent::process($settings);
    }
}
