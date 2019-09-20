<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config;

use Pbraiders\Config\ArrayFactory;
use Pbraiders\Config\Reader\FileMandatory;
use Pbraiders\Config\Reader\FileOptional;
use Pbraiders\Pomponne\Service\Config\Exception;
use Pbraiders\Pomponne\Service\Config\Processor\Session;
use Pbraiders\Pomponne\Service\Config\Processor\Website;

/**
 * Config factory.
 */
class Factory
{
    /**
     * Build an array from php file.
     *
     * @param string $dir Current working directory.
     * @throws Exception\InvalidWorkingDirException If the current working dir is not valid
     * @throws \RuntimeException If file does not exist.
     * @return array
     */
    public function create(string $dir): array
    {
        // Init
        $sCurrentWorkingDirectory = trim($dir);
        if (
            (strlen($sCurrentWorkingDirectory) == 0)
            || !is_dir($sCurrentWorkingDirectory)
            || !is_readable($sCurrentWorkingDirectory)
        ) {
            throw new Exception\InvalidWorkingDirException(
                \sprintf(
                    "the directory %s does not exist or is not writable.",
                    $sCurrentWorkingDirectory
                )
            );
        }

        // Main reader
        $pReaderMain = new FileMandatory(new FileOptional());
        $pReaderMain->setSource(
            $sCurrentWorkingDirectory
                . \DIRECTORY_SEPARATOR . 'pbr'
                . \DIRECTORY_SEPARATOR . 'config'
                . \DIRECTORY_SEPARATOR . 'config.php'
        );

        // Local reader
        $pReaderLocal = new FileOptional();
        $pReaderMain->setSource(
            $sCurrentWorkingDirectory
                . \DIRECTORY_SEPARATOR . 'pbr'
                . \DIRECTORY_SEPARATOR . 'config'
                . \DIRECTORY_SEPARATOR . 'local.config.php'
        );

        // Chain of processors
        $pProcessor = new Website();
        $pProcessor->setNext(new Session());

        // Create the factory
        $pArrayFactory = new ArrayFactory($pReaderMain, $pReaderLocal);
        $pArrayFactory->setProcessor($pProcessor);

        return $pArrayFactory->create();
    }
}
