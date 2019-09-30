<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application\Initializer
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Application;

/**
 * Interface for Init strategies.
 */
interface InitializerInterface
{

    /**
     * Working dir setter.
     *
     * @param string $dir Working directory
     * @return InitializerInterface
     */
    public function setWorkingDir(string $dir): InitializerInterface;

    /**
     * Method for quick and easy initialization of the Application.
     *
     * @return \Pbraiders\Pomponne\Application\Application
     */
    public function initialize(): Application;
}
