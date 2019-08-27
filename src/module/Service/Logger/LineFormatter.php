<?php

declare(strict_types=1);

/**
 * @see https://github.com/Seldaek/monolog
 * @package Pbraiders\Service\Logger
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Logger;

/**
 * Formats incoming records into a one-line apache log like string.
 *
 */
class LineFormatter extends \Monolog\Formatter\LineFormatter
{

    public function __construct()
    {
        // New formats
        $sOutputFormat = '[%extra.ip%] [%extra.user%] [%datetime%] [%channel%:%level_name%] "%extra.http_method% %extra.url%" %message% "%extra.referrer%" %context% %extra%' . PHP_EOL;

        $sDateFormat = 'Y-m-d H:i:s.u';

        // Initialize
        parent::__construct($sOutputFormat, $sDateFormat);
    }
}
