<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor;

use Pbraiders\Config\Processor\Processor;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Modifies php section of the settings.
 */
class Session extends Processor
{

    /**
     * Update the session.cookie_domain setting.
     *
     * @param array $aSettings
     * @throws \RuntimeException If settings is missing.
     * @return void
     */
    protected function processCookieDomain(array &$aSettings): void
    {
        // Init

        /** @var array */
        $aFilter = [
            'application' => [
                'website' => [
                    'host' => true,
                ],
            ],
        ];

        // Retrieves the values

        /** @var mixed|null */
        $sValue = extractDepthKeyInArray($aSettings, $aFilter);
        if (! is_string($sValue)) {
            throw new \RuntimeException('The application.website.host setting is missing in the config file.');
        }
        $sValue = trim($sValue);
        if (strlen($sValue) == 0) {
            throw new \RuntimeException('The application.website.host setting is not a valid.');
        }

        // Update php session settings
        $aSettings['php']['session.cookie_domain'] = $sValue;
    }

    /**
     * Update the session.save_path setting.
     *
     * @param array $aSettings
     * @throws \RuntimeException If settings is missing.
     * @return void
     */
    protected function processSessionSavePath(array &$aSettings): void
    {
        // Init

        /** @var array */
        $aFilter = [
            'application' => [
                'temporary_path' => true,
            ],
        ];

        // Retrieves the values

        /** @var mixed|null */
        $sValue = extractDepthKeyInArray($aSettings, $aFilter);
        if (! is_string($sValue)) {
            throw new \RuntimeException('The application.temporary_path setting is missing in the config file.');
        }
        $sValue = trim($sValue);
        if (strlen($sValue) == 0) {
            throw new \RuntimeException('The application.temporary_path setting is not valid.');
        }
        if (! is_dir($sValue) || ! is_writable($sValue)) {
            throw new \RuntimeException('The application.temporary_path setting is not a directory nor writeable.');
        }
        // Update php session settings
        $aSettings['php']['session.save_path'] = $sValue;
    }

    /**
     * Update the session.cookie_secure setting.
     *
     * @param array $aSettings
     * @throws \RuntimeException If settings is missing.
     * @return void
     */
    protected function processCookieSecure(array &$aSettings): void
    {
        // Init

        /** @var array */
        $aFilter = [
            'application' => [
                'website' => [
                    'scheme' => true,
                ],
            ],
        ];

        /** @var array */
        $aSchemes = ["http", "https"];

        // Retrieves the value

        /** @var mixed|null */
        $sValue = extractDepthKeyInArray($aSettings, $aFilter);
        if (! is_string($sValue)) {
            throw new \RuntimeException('The application.website.scheme setting is missing in the config file.');
        }
        $sValue = strtolower($sValue);
        if (! in_array($sValue, $aSchemes, true)) {
            throw new \RuntimeException('The application.website.scheme setting is not valid.');
        }

        // Update php session settings
        if (strcasecmp('https', $sValue) == 0) {
            $aSettings['php']['session.cookie_secure'] = '1';
        } else {
            $aSettings['php']['session.cookie_secure'] = '0';
        }
    }

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely an array
     * @throws \RuntimeException If settings is missing or is not valid.
     * @return mixed Returns the modified config.
     */
    public function process($settings)
    {
        // Update php session settings
        $this->processCookieDomain($settings);
        $this->processSessionSavePath($settings);
        $this->processCookieSecure($settings);

        // Next
        return parent::process($settings);
    }
}
