<?php

declare(strict_types=1);

/**
 * Config factory.
 *
 * Reads the main config file and return it as a sorted array.
 * If the local.config.php file exists, its content replace the main config file content.
 *
 * @package Pbraiders\Service\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Config;

use Pbraiders\Service\Exception;
use Pbraiders\Service\Utils\Stdlib;
use League\Uri\Parser;

/**
 * Create config
 */
class Factory
{

    /**
     * Main config filename.
     *
     * @var string
     */
    const DEFAULT_FILENAME_MAIN = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'config.php';

    /**
     * Local config filename
     *
     * @var string
     */
    const DEFAULT_FILENAME_LOCAL = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'local.config.php';

    /**
     * Nuild an array from php file.
     *
     * @throws Exception\RuntimeException
     * @return void
     */
    public function create(string $main = '', string $local = ''): array
    {
        // Reads the files.
        $aSettings = $this->readMainConfig($main);
        $aLocalSettings = $this->readLocalConfig($local);

        // Replace main settings with local settings.
        if (!empty($aLocalSettings)) {
            $aSettings = array_replace_recursive($aSettings, $aLocalSettings);
        }

        // Update many settings
        $this->updateWebsiteSettings($aSettings);
        $this->updateSessionSettings($aSettings);

        // Sorts
        Stdlib::sortArrayByKey($aSettings);

        return $aSettings;
    }

    /**
     * Update the application wabsite settings
     *
     * @param array $aSettings The settings
     * @return void
     */
    protected function updateWebsiteSettings(array &$aSettings): void
    {
        // Parse the url according to RFC3986
        if (empty($aSettings['application']['website']['url'])) {
            throw new Exception\RuntimeException('The application.website.url setting is missing in the config file.');
        }
        $aWebsite = &$aSettings['application']['website'];
        $pParser = new Parser();
        $aWebsite = array_merge($aWebsite, $pParser($aWebsite['url']));
    }

    /**
     * Update the php session settings
     *
     * @param array $aSettings The settings
     * @return void
     */
    protected function updateSessionSettings(array &$aSettings): void
    {
        // Mandatory settings
        if (empty($aSettings['application']['temporary_path'])) {
            throw new Exception\RuntimeException('The application.temporary_path setting is missing in the config file.');
        }
        // Update
        $aSettings['php']['session.cookie_domain'] = $aSettings['application']['website']['host'];
        $aSettings['php']['session.save_path'] = $aSettings['application']['temporary_path'];
        if ('https' === $aSettings['application']['website']['scheme']) {
            $aSettings['php']['session.cookie_secure'] = '1';
        }
    }

    /**
     * Reads the main config file.
     *
     * @param string $filename
     * @throws Exception\RuntimeException If file does not exist
     * @return array
     */
    protected function readMainConfig(string $filename = ''): array
    {
        // Init
        $filename = trim($filename);
        $sFilename = empty($filename) ? static::DEFAULT_FILENAME_MAIN : $filename;

        // File must exists
        if (!is_readable($sFilename)) {
            throw new Exception\RuntimeException(sprintf('The config file "%s" cannot be found.', $sFilename));
        }

        // Reads the main config file
        $aSettings = require $sFilename;

        return $aSettings;
    }

    /**
     * If exists, reads the local config file.
     *
     * @param string $filename
     * @return array
     */
    protected function readLocalConfig(string $filename = ''): array
    {
        // Init
        $aSettings = [];
        $filename = trim($filename);
        $sFilename = empty($filename) ? static::DEFAULT_FILENAME_LOCAL : $filename;

        // Reads the local config file if exists.
        if (is_readable($sFilename)) {
            $aSettings = require $sFilename;
        }

        return $aSettings;
    }
}
