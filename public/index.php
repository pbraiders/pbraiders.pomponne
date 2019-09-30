<?php

declare(strict_types=1);

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Bootstrap\RegisterDefinition;
use Pbraiders\Pomponne\Application\Initializer\Main;
use Pbraiders\Pomponne\Application\Run\SlimBridge;

/**
 * Public entry point.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
if (! chdir(dirname(__DIR__))) {
    exit(30);
}

// Includes the Composer autoloader
require 'lib' . \DIRECTORY_SEPARATOR . 'autoload.php';

(Application::init(new Main()))
    ->bootstrap(new RegisterDefinition())
    ->run(new SlimBridge());
