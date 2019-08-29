<?php

namespace PbraidersTest\Service;

use Psr\Log\LoggerInterface;
use League\Container\Container;
use Slim\App;
use Pbraiders\Service\Exception;
use Pbraiders\Service\ServiceProvider;
use Pbraiders\Service\Utils\Stdlib;
use PbraidersTest\Utils\ReflectionTraits;

class ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTraits;

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterFramework()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerFramework');
        $pMethod->invoke($pServiceProvider);
        $this->assertTrue($pServiceProvider->provides(App::class));
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterErrorHandler()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerErrorHandler');
        $pMethod->invoke($pServiceProvider);
        $this->assertTrue($pServiceProvider->provides('whoops'));
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterStdlib()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerStdlib');
        $pMethod->invoke($pServiceProvider);
        $this->assertTrue($pServiceProvider->provides(Stdlib::class));
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterSettings()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerSettings');
        $pMethod->invoke($pServiceProvider);
        $this->assertTrue($pServiceProvider->provides('settings'));
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterLogger()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerSettings');
        $pMethod->invoke($pServiceProvider);
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerLogger');
        $pMethod->invoke($pServiceProvider);
        $this->assertTrue($pServiceProvider->provides(LoggerInterface::class));
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegisterLoggerException()
    {
        $pContainer = new Container();
        $pContainer->share('settings', ['module' => ['whereis' => 'logger ?']]);
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer($pContainer);
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'registerLogger');
        $this->expectException(Exception\RuntimeException::class);
        $pMethod->invoke($pServiceProvider);
    }

    /**
     * @covers \Pbraiders\Service\ServiceProvider
     * @group specification
     */
    public function testRegister()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pServiceProvider);
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\ServiceProvider', 'register');
        $pMethod->invoke($pServiceProvider);

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pServiceProvider->provides($sProperty));
        }
    }
}
