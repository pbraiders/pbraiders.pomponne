<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application;

use Pbraiders\Config\Exception\FileDoNotExistNorReadableException;
use Pbraiders\Pomponne\Service\Config\Exception\DirectoryNotExistNorWritableException;
use Pbraiders\Pomponne\Application\Exception\WorkingDirNotValidException;
use Pbraiders\Pomponne\Service\Config\Factory as ConfigFactory;
use Pbraiders\Pomponne\Service\ErrorHandler\Factory as ErrorHandlerFactory;

use function Pbraiders\Stdlib\configurePHP;
use function Pbraiders\Stdlib\extractDepthKeyInArray;

class Application
{

    /**
     * Constructor.
     *
     * @param string|null $dir Working dir.
     */
    //    public function __construct(?string $dir = null)
    //    { }

    /**
     * Constructor.
     */
    public function run(): void
    {
        echo 'hello', PHP_EOL;
    }

    /**
     * Static method for quick and easy initialization of the Application.
     *
     * @param string|null $dir Working directory
     * @throws WorkingDirNotValidException If the working directory parameter is not valid.
     * @throws DirectoryNotExistNorWritableException If the current working dir is not valid.
     * @throws FileDoNotExistNorReadableException If the ocnfig file does not exist.
     * @return Application
     */
    public static function init(?string $dir = null): Application
    {
        /**
         * Defines the working directory.
         *
         * We keep the actual working directory.
         * This method works well in production and development environment.
         *
         * @var string|bool $sWorkingDir Working dir.
         */
        $sWorkingDir = is_null($dir) ? getcwd() : trim($dir);
        if ((false === $sWorkingDir) || (strlen($sWorkingDir) == 0)) {
            throw new WorkingDirNotValidException("The working directory is not defined.");
        }

        /**
         * Loads the settings from the configuration files.
         *
         * We use the config factory helper to loads and merges the configuration files.
         *
         * @var array $aSetting Settings.
         */
        $aSettings = (new ConfigFactory())->create($sWorkingDir);

        /**
         * Configures PHP.
         *
         * We modify the configuration options using the ini_set php command.
         * These options will keep there new values during the script's execution,
         * and will be restored at the script's ending.
         */
        if (count($aSettings['php']) > 0) {
            configurePHP($aSettings['php']);
        }

        /**
         * In debug mode / development environment we activate Whoops globally, not as a middleware.
         *
         * Whoops is an error handler framework for PHP.
         * Out-of-the-box, it provides a pretty error interface that helps you debug your web projects,
         * but at heart it's a simple yet powerful stacked error handling system.
         */
        $bUseWhoops = extractDepthKeyInArray($aSettings, ['service' => ['error' => ['use_whoops' => true]]]);
        if (true === $bUseWhoops) {
            (new ErrorHandlerFactory())->create()->register();
        }

        return new Application();
    }
}




/** @var PhpDiFactory $pContainerFactory Helper to create and configure the PSR-11 container. */
//$pContainerFactory = (new ContainerFactory())->create($aSettings);

//exit(print_r($aSettings, true));

/**
 * Creates the container and loads all the needed services.
 * In order to use the dependency injection pattern.
 *
 * @var \Psr\Container\ContainerInterface $pContainer
 */
//$pContainer = $pContainerBuilder->build();

/*
$pContainer = \Pbraiders\Service\Container\Factory::createFromInvokables(
    [
        // Add the services provider.
        \Pbraiders\Service\Config\ServiceProvider::class,
        \Pbraiders\Service\Utils\ServiceProvider::class,
        \Pbraiders\Service\ErrorHandler\ServiceProvider::class,
        \Pbraiders\Service\Logger\ServiceProvider::class,
        \Pbraiders\Service\TemplatingEngine\ServiceProvider::class,
        // Add the mediators provider.
        \Pbraiders\App\Home\ServiceProvider::class,
    ]
);
*/

/**
 * Loads the settings.
 *
 * In order to configure many things before the app runs.
 *
 * @var array $aSettings
 */
//$aSettings = $pContainer->get('settings');




/**
 * Instantiate App
 *
 * In order for the app to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 *
 * @var Slim\App $pApplication
 */
//$pApplication = \Slim\Factory\AppFactory::createFromContainer($pContainer);

/**
 * Register middlewares
 */
//$callable = require \PBR_PATH . \DIRECTORY_SEPARATOR . 'module' . \DIRECTORY_SEPARATOR . 'Middleware' . \DIRECTORY_SEPARATOR . 'middleware.php';
//$callable($pApplication);

/**
 * Register routes.
 */
//$callable = require \PBR_PATH . \DIRECTORY_SEPARATOR . 'module' . \DIRECTORY_SEPARATOR . 'App' . \DIRECTORY_SEPARATOR . 'routes.php';
//$callable($pApplication);

// Run app
//$pApplication->run();

// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
