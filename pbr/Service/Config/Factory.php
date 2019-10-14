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
use Pbraiders\Pomponne\Service\Config\Processor\Application\CachePath;
use Pbraiders\Pomponne\Service\Config\Processor\Application\TemporaryPath;
use Pbraiders\Pomponne\Service\Config\Processor\Application\Website;
use Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir;
use Pbraiders\Pomponne\Service\Config\Processor\Service\Logger;
use Pbraiders\Pomponne\Service\Config\Processor\Php\ErrorLog;
use Pbraiders\Pomponne\Service\Config\Processor\Php\Session;

/**
 * Config factory.
 */
final class Factory
{
    /**
     * Build an array from php file.
     *
     * @param string $dir Current working directory.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If the current working dir is not valid
     * @throws \Pbraiders\Config\Exception\FileDoNotExistNorReadableException If file does not exist.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If a setting is not valid.
     * @return array
     */
    public function create(string $dir): array
    {
        // Init
        $sCurrentWorkingDirectory = trim($dir);
        if ((strlen($sCurrentWorkingDirectory) == 0)
            || ! is_dir($sCurrentWorkingDirectory)
            || ! is_readable($sCurrentWorkingDirectory)
        ) {
            throw new Exception\InvalidAccessPermissionException(
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
        $pReaderLocal->setSource(
            $sCurrentWorkingDirectory
                . \DIRECTORY_SEPARATOR . 'pbr'
                . \DIRECTORY_SEPARATOR . 'config'
                . \DIRECTORY_SEPARATOR . 'local.config.php'
        );

        // Chain of processors
        $pProcessor = new WorkingDir();
        $pProcessor
            ->setWorkingDir($sCurrentWorkingDirectory)
            ->setNext(new TemporaryPath())
            ->setNext(new CachePath())
            ->setNext(new Website())
            ->setNext(new Logger())
            ->setNext(new ErrorLog())
            ->setNext(new Session());

        // Create the factory
        $pArrayFactory = new ArrayFactory($pReaderMain, $pReaderLocal);
        $pArrayFactory->setProcessor($pProcessor);

        return $pArrayFactory->create();
    }
}
