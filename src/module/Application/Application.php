<?php

declare(strict_types=1);

/**
 *
 * @package Pbraiders\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Application;

class Application
{

    public static function init(array $configuration = [])
    {
        // Prepare the service manager
    }

    function hello(): void
    {
        echo '<p>hello</p>', PHP_EOL;
    }
}
