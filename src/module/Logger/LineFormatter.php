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
 * Formats incoming records into a one-line apache log like string.
 *
 */
class LineFormatter extends \Monolog\Formatter\LineFormatter
{

    public function __construct()
    {
        //"%h %l %u %t \"%r\" %>s %b \"%{Referer}i\" \"%{User-agent}i\""
        //"%h %l %u [%{%Y-%m-%d %H:%M:%S}t.%{usec_frac}t] \"%r\" %>s %O \"%{Referer}i\" \"%{User-Agent}i\""
        // %h Serveur distant.
        // %l -
        // %u L'utilisateur distant (en provenance d'auth ; peut être faux si le statut de retour (%s) est 401).
        // [%{%Y-%m-%d %H:%M:%S}t.%{usec_frac}t] La date.
        // %r La première ligne de la requête
        // %s Statut
        // %O - octet envoyé
        //
        // "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n";
        $sFormat = "[%datetime%] [%channel%:%level_name%] [%extra.user%] [%extra.ip%] \"%extra.http_method% %extra.url%\" %message% \"%http_referer}\" %context% %extra%\n";
        parent::__construct($sFormat);
    }

}
