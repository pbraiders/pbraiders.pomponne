<?php

declare(strict_types=1);

/**
 * Loads the application environment.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// Defines the root path.
define('PBR_PATH', __DIR__);

// Includes the Composer autoloader
require 'vendor/autoload.php';

// Retrieves the configuration
$aConfig = require 'config/config.php';
if (is_readable('config/local.config.php')) {
    $aConfig = array_replace_recursive($aConfig, require 'config/local.config.php');
}

function setIni($newvalue, string $sVarname)
{
    echo '<pre>varname=' . $sVarname . '</pre>', PHP_EOL;
    echo '<pre>newvalue=' . $newvalue . '</pre>', PHP_EOL;
    @ini_set($sVarname, (string) $newvalue);
}

echo '<pre>' . print_r($aConfig['php'], true) . '</pre>', PHP_EOL;

array_walk($aConfig['php'], 'setIni');


$pApplication = new \Pbraiders\Application\Application();
$pApplication->hello();
$pApplication = null;
unset($pApplication);

error_log("You messed up!", 3, "/home/ojullien/work/pomponne/src/log/my-errors.log");
