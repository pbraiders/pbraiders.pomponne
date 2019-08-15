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

/*
// Loads the configuration
$pConfigFactory = new \Pbraiders\Config\Factory();
$pConfig = $pConfigFactory->fromFile(PBR_PATH . '/config/config.php');
echo '<pre>', PHP_EOL;
print_r($pConfig);
echo '</pre>', PHP_EOL;
*/


/*
// This works.
// Retrieves the configuration
$aConfig = require 'config/config.php';
if (is_readable('config/local.config.php')) {
   $aConfig = array_replace_recursive($aConfig, require 'config/local.config.php');
}

$container = new League\Container\Container;
$container->share(Pbraiders\Config\Config::class)->addArgument($aConfig);
$pConfig = $container->get(Pbraiders\Config\Config::class);
var_dump($pConfig instanceof Pbraiders\Config\Config);               // true

echo '<pre>', PHP_EOL;
print_r($pConfig);
echo '</pre>', PHP_EOL;
*/

// This works.
$container = new League\Container\Container();
$container->addServiceProvider( new \Pbraiders\Config\ServiceProvider() );

echo '<pre>', PHP_EOL;
print_r($container->has('config'));
echo '</br>', PHP_EOL;
$pConfig = $container->get('config');
print_r($pConfig);
echo '</pre>', PHP_EOL;

//pConfig = $container->get(Pbraiders\Config\Config::class);
/*var_dump($pConfig instanceof Pbraiders\Config\Config);               // true

// Updates the PHP configuration
function setIni($newvalue, string $sVarname)
{
    echo '<pre>init_set=' . $sVarname . '</pre>', PHP_EOL;
    @ini_set($sVarname, (string) $newvalue);
}
$aaaaa = $pConfig['php']->toArray();
array_walk($aaaaa, 'setIni');
*/

$pApplication = new \Pbraiders\Application\Application();
$pApplication->hello();
$pApplication = null;
unset($pApplication);

//error_log("You messed up!", 3);
