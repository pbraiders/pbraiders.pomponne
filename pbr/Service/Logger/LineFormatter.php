<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Logger
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Logger;

use Monolog\Formatter\LineFormatter as MonologLineFormatter;

/**
 * Formats incoming records into a one-line apache log like string.
 * Extends the \Monolog\Formatter\LineFormatter by formatting the output.
 * @see https://github.com/Seldaek/monolog
 */
final class LineFormatter extends MonologLineFormatter
{
    public function __construct()
    {
        // New formats
        $sOutputFormat = '[%extra.ip%] [%extra.user%] [%datetime%] [%channel%:%level_name%] '
            . '"%extra.http_method% %extra.url%" %message% "%extra.referrer%" %context% %extra%' . PHP_EOL;

        $sDateFormat = 'Y-m-d H:i:s.u';

        // Initialize
        parent::__construct($sOutputFormat, $sDateFormat);
    }
}
