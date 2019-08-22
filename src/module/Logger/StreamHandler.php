<?php

declare(strict_types=1);

/**
 * @see https://github.com/Seldaek/monolog
 * @package Pbraiders\Logger
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Logger;

/**
 * Monolog stream handler.
 * Stores to any stream resource.
 */
class StreamHandler extends \Monolog\Handler\StreamHandler
{
    /**
     * Stores to any stream resource.
     * Only used to store into local files.
     *
     * @param array $config Must contains [ 'error_log' => 'filename' ]
     *
     * @throws \Pbraiders\Logger\Exception\InvalidArgumentException If the configuration is not valid.
     */
    public function __construct(array $config)
    {
        // Filter the logger configuration.
        $aFilter = [ 'error_log' => true ];
        $aConfig = array_intersect_key($config, $aFilter);

        if (count($aConfig) != count($aFilter)) {
            throw new Exception\InvalidArgumentException('Logger configuration is not valid.');
        }

        parent::__construct((string)$aConfig['error_log']);
    }
}