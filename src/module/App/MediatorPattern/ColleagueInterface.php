<?php

declare(strict_types=1);

/**
 * Interface for colleague.
 *
 * @package Pbraiders\App\Mediator
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\MediatorPattern;

use Pbraiders\App\MediatorPattern\Mediator;

/**
 * Undocumented interface
 */
interface ColleagueInterface
{
    /**
     * Undocumented function
     *
     * @param \Pbraiders\App\MediatorPattern\Mediator $mediator
     * @return void
     */
    public function setMediator(Mediator $mediator): void;
}
