<?php

declare(strict_types=1);

/**
 * Loads the application environment.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// Includes the Composer autoloader
require 'vendor/autoload.php';

// Retrieves the configuration
$appConfig = require 'config/config.php';
if (is_readable('config/local.config.php')) {
    $appConfig = array_merge_recursive($appConfig, require 'config/local.config.php');
}

$pApplication = new \Pbraiders\Application\Application();
$pApplication->hello();
$pApplication = null;
unset($pApplication);
