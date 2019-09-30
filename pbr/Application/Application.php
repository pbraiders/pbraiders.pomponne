<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Application;

use Pbraiders\Pomponne\Application\Bootstrap\BootstrapInterface;
use Pbraiders\Pomponne\Application\Initializer\InitializerInterface;
use Pbraiders\Container\FactoryInterface;
use Pbraiders\Pomponne\Application\Run\RunInterface;

class Application
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
     * Static method for quick and easy initialization of the Application.
     *
     * @param \Pbraiders\Pomponne\Application\Initializer\InitializerInterface $initializer
     * @return \Pbraiders\Pomponne\Application\Application
     */
    public static function init(InitializerInterface $initializer): Application
    {
        return $initializer->initialize();
    }

    /**
     * Registers dependencies.
     *
     * @param \Pbraiders\Pomponne\Application\Bootstrap\BootstrapInterface $bootstrapper
     * @return self
     */
    public function bootstrap(BootstrapInterface $bootstrapper): self
    {
        $bootstrapper
            ->setContainerFactory($this->pContainerFactory)
            ->bootstrap();

        return $this;
    }

    /**
     * Run the App.
     *
     * @return void
     */
    public function run(RunInterface $runner): void
    {
        $runner
            ->setContainerFactory($this->pContainerFactory)
            ->run();
    }
}

// Now
// Session http://paul-m-jones.com/post/2016/04/12/psr-7-and-session-cookies/
//https://github.com/psr7-sessions/storageless
//https://docs.zendframework.com/zend-expressive-session/intro/
// https://github.com/dflydev/dflydev-fig-cookies
//https://discourse.zendframework.com/t/rfc-php-session-and-psr-7/294

// middleware https://akrabat.com/writing-psr-7-middleware/
// https://github.com/middlewares/psr15-middlewares
//https://github.com/middlewares/awesome-psr15-middlewares#dispatcher
