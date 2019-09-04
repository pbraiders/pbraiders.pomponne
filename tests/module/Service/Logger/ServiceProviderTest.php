<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Logger;

use League\Container\Container;
use Pbraiders\Service\Exception;
use Pbraiders\Service\Logger\ServiceProvider as LoggerProvider;
use Pbraiders\Service\Config\ServiceProvider as ConfigProvider;
use PbraidersTest\Utils\ReflectionTrait;

class ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\Logger\ServiceProvider
     * @group specification
     */
    public function testRegister()
    {
        $pContainer = new Container();
        $pConfigProvider = new ConfigProvider();
        $pLoggerProvider = new LoggerProvider();

        $pConfigProvider->setContainer($pContainer);
        $pLoggerProvider->setContainer($pContainer);

        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\Logger\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pLoggerProvider);

        $pConfigProvider->register();
        $pLoggerProvider->register();

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pContainer->has($sProperty), 'Looking for:' . $sProperty);
        }
    }

    /**
     * @covers \Pbraiders\Service\Logger\ServiceProvider
     * @group specification
     */
    public function testRegisterException()
    {
        $pContainer = new Container();
        $pEngineProvider = new LoggerProvider();
        $pEngineProvider->setContainer($pContainer);
        $pContainer->add('settings', []);
        $this->expectException(Exception\RuntimeException::class);
        $pEngineProvider->register();
    }
}
