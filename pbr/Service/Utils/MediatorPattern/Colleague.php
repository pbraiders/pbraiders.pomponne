<?php

declare(strict_types=1);

/**
 * Abstract class for colleague.
 *
 * @package Pbraiders\App\Mediator
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Utils\MediatorPattern;

use Pbraiders\Service\Utils\MediatorPattern\Mediator;
use Pbraiders\Service\Utils\MediatorPattern\ColleagueInterface;

/**
 * Undocumented class
 */
abstract class Colleague implements ColleagueInterface
{
    /**
     * Undocumented variable
     *
     * @var \Pbraiders\Service\Utils\MediatorPattern\Mediator|null
     */
    protected $pMediator = null;

    /**
     * Undocumented function
     *
     * @param \Pbraiders\Service\Utils\MediatorPattern\Mediator $mediator
     * @return void
     */
    public function setMediator(Mediator $mediator): void
    {
        $this->pMediator = $mediator;
    }
}
