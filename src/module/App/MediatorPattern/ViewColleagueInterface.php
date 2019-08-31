<?php

declare(strict_types=1);

/**
 * Interface for view colleague.
 *
 * @package Pbraiders\App\MediatorPattern
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\MediatorPattern;

use League\Plates\Engine;

/**
 * Undocumented interface
 */
interface ViewColleagueInterface
{
    /**
     * Undocumented function
     *
     * @param \League\Plates\Engine $engine
     * @return void
     */
    public function setEngine(Engine $engine): void;
}
