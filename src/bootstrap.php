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

try {

    // Loads all the needed services
    $container = new League\Container\Container();
    $container
        ->addServiceProvider( new \Pbraiders\Config\ServiceProvider() )
        ->addServiceProvider( new \Pbraiders\Application\ServiceProvider() )
        ->addServiceProvider( new \Pbraiders\Logger\ServiceProvider() );

    echo '<pre>', PHP_EOL;
    print_r($container->has('config'));
    print_r($container->has('application'));
    print_r($container->has('logger'));
    print_r($container->has('logger.handler.stream'));
    echo '</pre>', PHP_EOL;

    // Configures the application
    $aConfig = $container->get('config');
    $pApplication = $container->get('application');
    $return = $pApplication->configurePHP($aConfig['php']);
    echo '<pre>configurePHP returns: ';
    print_r($return);
    echo '</br>', PHP_EOL;
    $pLogger = $container->get('logger');
    var_dump($pLogger);
    $pLogger = $container->get('logger.handler.stream');
    var_dump($pLogger);
    //$pLogger->info('My logger is now ready');
    echo '</br>', PHP_EOL;
    print_r($aConfig);
    echo '</pre>', PHP_EOL;

}
catch ( \Exception $e ){
    var_dump($e->getMessage());
    exit(1);
}

//error_log("You messed up!", 3);
