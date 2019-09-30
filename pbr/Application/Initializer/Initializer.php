<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Initializer
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Initializer;

/**
 * Add working dir setter and methods.
 */
abstract class Initializer implements InitializerInterface
{

    /**
     * Working directory
     *
     * @var string|bool|null
     */
    protected $sWorkingDir = \null;

    /**
     * Working dir setter.
     *
     * @param string $dir Working directory
     * @return InitializerInterface
     */
    public function setWorkingDir(string $dir): InitializerInterface
    {
        $this->sWorkingDir = trim($dir);
        return $this;
    }
}
