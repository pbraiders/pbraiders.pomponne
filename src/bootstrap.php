<?php

/**
 * Loads the application environment.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// Composer autoloading
include __DIR__ . '/vendor/autoload.php';

$pApplication = new \Pbraiders\Application\Application();
$pApplication->hello();
$pApplication = null;
unset($pApplication);
