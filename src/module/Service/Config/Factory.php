<?php

declare(strict_types=1);

/**
 * Config factory.
 *
 * @package Pbraiders\Service\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Config;

use Pbraiders\Service\Exception;
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
    public static function create(string $main = '', string $local = ''): array
    {
        // Init
        $main = trim($main);
        $local = trim($local);
        $sConfigFileMain = empty($main) ? static::DEFAULT_FILENAME_MAIN : $main;
        $sConfigFileLocal = empty($local) ? static::DEFAULT_FILENAME_LOCAL : $local;

        // File must exists
        if (!is_readable($sConfigFileMain)) {
            throw new Exception\RuntimeException(sprintf('The config file "%s" cannot be found.', $sConfigFileMain));
        }

        // Reads the main config file
        $aSettings = require $sConfigFileMain;

        // Reads the local config file
        if (is_readable($sConfigFileLocal)) {
            $aSettings = array_replace_recursive($aSettings, require $sConfigFileLocal);
        }

        // Parse the url
        if (!empty($aSettings['website']['url'])) {
            $aWebsite = &$aSettings['website'];
            $pParser = new Parser();
            $aWebsite = array_merge($aWebsite, $pParser($aWebsite['url']));
        }

        ksort($aSettings);

        // Register
        return $aSettings;
    }
};
