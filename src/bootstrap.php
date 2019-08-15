<?php

declare(strict_types=1);

use SebastianBergmann\CodeCoverage\Report\PHP;

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

// Loads services
$container = new League\Container\Container();
$container->addServiceProvider( new \Pbraiders\Config\ServiceProvider() );
$container->addServiceProvider( new \Pbraiders\Application\ServiceProvider() );
echo '<pre>', PHP_EOL;
print_r($container->has('config'));
print_r($container->has('application'));
echo '</br>', PHP_EOL;
$aConfig = $container->get('config');
$pApplication = $container->get('application');
$pApplication->initPHP($aConfig['php']);
print_r($aConfig);
echo '</pre>', PHP_EOL;


//error_log("You messed up!", 3);
