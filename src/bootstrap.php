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

// Loads all the needed services.
$theContainer = new League\Container\Container();
$theContainer
    ->addServiceProvider( new \Pbraiders\Config\ServiceProvider() )
    ->addServiceProvider( new \Pbraiders\Application\ServiceProvider() )
    ->addServiceProvider( new \Pbraiders\Logger\ServiceProvider() );

// Get the config
$theConfig = $theContainer->get('config');

// Configure PHP
if(!empty($theConfig['php'])) {
    $theContainer->get('application')->configurePHP($theConfig['php']);
}

// Activate Whoops
if( (!empty($theConfig['modules']['application']['use_whoops']))) {
    echo '<pre>hello</pre>', PHP_EOL;
    $theContainer->get('whoops')->register();
}


    // Configures the application

    $pLogger = $theContainer->get('logger');
   $pLogger->info('My logger is now ready');
/*    var_dump($pLogger);
    echo '</br>', PHP_EOL;
    print_r($aConfig);
    echo '</pre>', PHP_EOL;

/*}
catch ( \Exception $e ){
    var_dump($e);
    exit(1);
}
*/
//error_log("You messed up!", 3);
