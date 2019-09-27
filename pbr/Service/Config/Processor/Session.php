<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor;

use Pbraiders\Config\Processor\Processor;
use Pbraiders\Pomponne\Service\Config\Exception;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Modifies php section of the settings.
 */
final class Session extends Processor
{

    /**
     * Update the session.cookie_domain setting.
     *
     * @param array $settings
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If host setting is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If host setting is not valid.
     * @return void
     */
    protected function processCookieDomain(array &$settings): void
    {
        /**
         * Filters the settings
         */

        /** @var array $aFilter Website host filter */
        $aFilter = ['application' => ['website' => ['host' => true]]];
        $aSettings = \array_intersect_key($settings, $aFilter);

        /** @var mixed|null $sHost The host*/
        $sHost = extractDepthKeyInArray($aSettings, $aFilter);
        if (!is_string($sHost)) {
            throw new Exception\MissingSettingException('The application.website.host setting is missing.');
        }
        $sHost = trim($sHost);
        if (strlen($sHost) == 0) {
            throw new Exception\InvalidSettingException('The application.website.host setting is not a valid.');
        }

        /**
         * Update php session settings
         */
        $settings['php']['session.cookie_domain'] = $sHost;
    }

    /**
     * Update the session.save_path setting.
     *
     * @param array $settings
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If temporary_path setting is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If temporary_path setting is not valid.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If directory does not exist nor writable.
     * @return void
     */
    protected function processSessionSavePath(array &$settings): void
    {
        /**
         * Filters the settings
         */

        /** @var array $aFilter temporary path filter */
        $aFilter = ['application' => ['temporary_path' => true]];
        $aSettings = \array_intersect_key($settings, $aFilter);

        /** @var mixed|null $sPath The path*/
        $sPath = extractDepthKeyInArray($aSettings, $aFilter);
        if (!is_string($sPath)) {
            throw new Exception\MissingSettingException('The application.temporary_path setting is missing.');
        }
        $sPath = trim($sPath);
        if (strlen($sPath) == 0) {
            throw new Exception\InvalidSettingException('The application.temporary_path setting is not valid.');
        }
        if (!is_dir($sPath) || !is_writable($sPath)) {
            throw new Exception\InvalidAccessPermissionException('The application.temporary_path setting is not a directory nor writeable.');
        }

        /**
         * Update php session settings
         */
        $settings['php']['session.save_path'] = $sPath;
    }

    /**
     * Update the session.cookie_secure setting.
     *
     * @param array $settings
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If website scheme setting is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If website scheme setting is not valid.
     * @return void
     */
    protected function processCookieSecure(array &$settings): void
    {
        /**
         * Filters the settings
         */

        /** @var array $aFilter website scheme filter */
        $aFilter = ['application' => ['website' => ['scheme' => true]]];
        $aSettings = \array_intersect_key($settings, $aFilter);

        /** @var mixed|null $sScheme The scheme */
        $sScheme = extractDepthKeyInArray($aSettings, $aFilter);
        if (!is_string($sScheme)) {
            throw new Exception\MissingSettingException('The application.website.scheme setting is missing.');
        }
        $sScheme = strtolower(trim($sScheme));
        if (!in_array($sScheme, ["http", "https"], true)) {
            throw new Exception\InvalidSettingException('The application.website.scheme setting is not valid.');
        }

        /**
         * Update php session settings
         */
        if (strcasecmp('https', $sScheme) == 0) {
            $settings['php']['session.cookie_secure'] = '1';
        } else {
            $settings['php']['session.cookie_secure'] = '0';
        }
    }

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely an array
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If the setting is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If the setting is not valid.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If directory does not exist nor writable.
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
