<?php

declare(strict_types=1);

/**
 * Public entry point.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

use Pbraiders\Pomponne\Application\Application;
use Slim\App;

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
if (! chdir(dirname(__DIR__))) {
    exit(30);
}

// Includes the Composer autoloader.
require 'lib' . \DIRECTORY_SEPARATOR . 'autoload.php';

if (! class_exists(Application::class) || ! class_exists(App::class)) {
    throw new \RuntimeException(
        "Unable to load application.\n"
            . "- Type `composer install` if you are developing locally.\n"
    );
}

// Run the application!
Application::init([])->run();
