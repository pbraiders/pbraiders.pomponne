<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application;

use Pbraiders\Container\FactoryInterface;
use Pbraiders\Pomponne\Service\Config\Factory as ConfigFactory;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactory;
use Pbraiders\Pomponne\Service\ErrorHandler\Factory as ErrorHandlerFactory;

use function DI\factory;
use function DI\get;
use function Pbraiders\Stdlib\configurePHP;
use function Pbraiders\Stdlib\extractDepthKeyInArray;

final class Application
{
    /**
     * The PSR-11 container factory.
     *
     * @var \Pbraiders\Container\FactoryInterface
     */
    protected $pContainerFactory;

    /**
     * Constructor.
     *
     * @param \Pbraiders\Container\FactoryInterface $factory The PSR-11 container factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->pContainerFactory = $factory;
    }

    /**
     * Populates the container.
     *
     * @return self
     */
    public function bootstrap(): self
    {
        // Add the logger
        $this->pContainerFactory->registerDefinition(
            '\Psr\Log\LoggerInterface::class',
            [
                \Psr\Log\LoggerInterface::class => factory('\Pbraiders\Pomponne\Service\Logger\Factory::create')
                    ->parameter('settings', get('settings')),
            ],
            true
        );
        return $this;
    }

    /**
     * Run the Slim App.
     *
     * @throws \Pbraiders\Container\Exception\ProxyDirectoryNotExistNorWritableException If proxy directory does not exist or is not writable.
     * @throws \Pbraiders\Container\Exception\CacheDirectoryNotExistNorWritableException If cache directory does not exist or is not writable.
     * @throws \InvalidArgumentException when the proxy directory is null.
     * @return void
     */
    public function run(): void
    {
        /**
         * Creates the container and loads all the needed services.
         * In order to use the dependency injection pattern.
         */
        $pContainer = $this->pContainerFactory->createContainer();

        /**
         * Instantiate the app
         *
         * In order for the app to work you need to ensure you have installed
         * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
         * ServerRequest creator (included with Slim PSR-7)
         */
        $pApplication = \DI\Bridge\Slim\Bridge::create($pContainer);

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

        $pApplication->run();
    }

    /**
     * Static method for quick and easy initialization of the Application.
     *
     * @param string|null $dir Working directory
     * @throws \Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException If the working directory argument is not valid.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException If the working directory is not valid or not writable.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If a setting is missing.
     * @throws \Pbraiders\Config\Exception\FileDoNotExistNorReadableException If the config file does not exist.
     * @throws \InvalidArgumentException if the definition registrement is not valid.
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
            throw new Exception\InvalidWorkingDirectoryException("The working directory is not defined.");
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
         *
         * @var mixed $bUseWhoops Boolean is required.
         */
        $bUseWhoops = extractDepthKeyInArray($aSettings, ['service' => ['error' => ['use_whoops' => true]]]);
        if (true === $bUseWhoops) {
            (new ErrorHandlerFactory())->create()->register();
        }

        /**
         * Creates the container factory from the settings.
         */
        $pContainerFactory = (new ContainerFactory())->create($aSettings);
        $pContainerFactory->registerDefinition('settings', ['settings' => $aSettings], true);

        return new Application($pContainerFactory);
    }
}



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




// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
