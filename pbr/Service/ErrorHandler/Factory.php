<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\ErrorHandler
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\ErrorHandler;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

/**
 * Provides an error handler as a service.
 * We use whoops.
 */
final class Factory
{

    /**
     * Creates the error handler.
     *
     * @return \Whoops\Run
     */
    public function create(): Run
    {
        $pHandler = new Run();
        $pHandler->prependHandler(new PrettyPageHandler());
        return $pHandler;
    }
}
