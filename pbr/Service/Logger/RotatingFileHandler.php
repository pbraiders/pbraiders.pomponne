<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Logger;
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Logger;

use Monolog\Handler\RotatingFileHandler as MonologRotatingFileHandler;

/**
 * Stores logs to files that are rotated every day and a limited number of files are kept.
 * This rotation is only intended to be used as a workaround. Using logrotate to
 * handle the rotation is strongly encouraged when you can use it.
 * Extends the \Monolog\Handler\RotatingFileHandler to configure automaticaly the stream.
 * @see https://github.com/Seldaek/monolog
 */
class RotatingFileHandler extends MonologRotatingFileHandler
{
    /**
     * Stores logs to files that are rotated every day and a limited number of files are kept.
     *
     * @param array $settings Must contains [ 'error_log' => 'filename' ]
     *
     * @throws \Pbraiders\Pomponne\Service\Logger\Exception\MissingSettingException If the settings are not valid.
     * @throws \Pbraiders\Pomponne\Service\Logger\Exception\InvalidSettingException If stream is not a resource or string.
     * @throws \Exception If a missing directory is not buildable.
     */
    public function __construct(array $settings)
    {
        $aFilter = ['error_log' => true];
        $aSettings = \array_intersect_key($settings, $aFilter);

        if (\count($aSettings) != \count($aFilter)) {
            throw new Exception\MissingSettingException('The error_log setting is missing.');
        }

        if (!is_string($aSettings['error_log']) || (strlen(trim($aSettings['error_log'])) == 0)) {
            throw new Exception\InvalidSettingException('The error_log setting is not valid.');
        }

        parent::__construct($aSettings['error_log'], 45);
    }
}
