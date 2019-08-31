<?php

declare(strict_types=1);

/**
 * view colleague trait.
 *
 * @package Pbraiders\App\MediatorPattern
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\MediatorPattern;

use League\Plates\Engine;

/**
 * Undocumented class
 */
trait ViewColleagueTrait
{
    /**
     * Undocumented variable
     *
     * @var Engine
     */
    protected $pEngine = null;

    /**
     * Undocumented function
     *
     * @param \League\Plates\Engine $pEngine
     * @return void
     */
    public function setEngine(Engine $engine): void
    {
        $this->pEngine = $engine;
    }
}
