<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Config;

class Factory
{

    /**
     * Prefix used to name the local config file.
     *
     * @var string
     */
    protected $prefix = 'local.';

    /**
     * Read a config from a file.
     *
     * @param string $filename
     * @return Config
     * @throws Exception\RuntimeException
     */
    public function create(string $filename): Config
    {
        // Init
        $sFilename = realpath($filename);

        // File must exists
        if (!is_readable($sFilename)) {
            throw new Exception\RuntimeException(sprintf('The config file "%s" cannot be found.', $sFilename));
        }

        // Loads the main configuration
        $aConfig = require $sFilename;

        // Loads the local configuration
        $aPathParts = pathinfo($sFilename);
        $sLocalFilename = sprintf('%s%s%s%s', $aPathParts['dirname'], \DIRECTORY_SEPARATOR, $this->prefix, $aPathParts['basename']);
        if (is_readable($sLocalFilename)) {
            $aConfig = array_replace_recursive($aConfig, require $sLocalFilename);
        }

        return new Config($aConfig);
    }
}
