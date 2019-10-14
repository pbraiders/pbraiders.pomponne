<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor\Application;

use Pbraiders\Config\Processor\Processor;
use Pbraiders\Config\Processor\ProcessorInterface;
use Pbraiders\Pomponne\Service\Config\Exception;

/**
 * Adds the working dir to the settings.
 */
class WorkingDir extends Processor
{

    /**
     * Working directory
     *
     * @var string
     */
    protected $sWorkingDir = '';

    /**
     * Xorking directory setter.
     *
     * @param string $value The Working directory.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If a setting is not valid.
     * @return \Pbraiders\Config\Processor\ProcessorInterface
     */
    public function setWorkingDir(string $value): ProcessorInterface
    {
        $this->sWorkingDir = trim($value);
        if (strlen($this->sWorkingDir) == 0) {
            throw new Exception\InvalidSettingException('The working directory setting is not valid.');
        }
        return $this;
    }

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely, an array.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If settings is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If settings is not valid.
     * @throws \InvalidArgumentException If URl is not valid.
     * @return mixed Returns the modified config.
     */
    public function process($settings)
    {
        // Here
        $settings['application']['working_directory'] = $this->sWorkingDir;

        // Next
        return parent::process($settings);
    }
}
