<?php

declare(strict_types=1);

/**
 * View.
 *
 * @package Pbraiders\Debug\Home
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Debug;

use Pbraiders\Service\Utils\MediatorPattern\ViewColleague;

/**
 * View.
 */
class View extends ViewColleague
{
    /**
     * Undocumented function
     *
     * @return string
     */
    public function sayHello(): string
    {
        return 'Hello world !!!!' . PHP_EOL;
    }
}
