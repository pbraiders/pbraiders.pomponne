<?php

declare(strict_types=1);

/**
 * View.
 *
 * @package Pbraiders\App\Home
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Home;

use Pbraiders\App\MediatorPattern\Colleague;
use Pbraiders\App\MediatorPattern\ViewColleagueInterface;
use Pbraiders\App\MediatorPattern\ViewColleagueTrait;

/**
 * Undocumented class
 */
class View extends Colleague implements ViewColleagueInterface
{
    use ViewColleagueTrait;

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
