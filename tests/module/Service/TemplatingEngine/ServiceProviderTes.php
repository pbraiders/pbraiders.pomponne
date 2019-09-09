<?php

declare(strict_types=1);

namespace PbraidersTest\Service\TemplatingEngine;

use League\Container\Container;
use Pbraiders\Service\Exception;
use Pbraiders\Service\TemplatingEngine\ServiceProvider as EngineProvider;
use Pbraiders\Service\Config\ServiceProvider as ConfigProvider;
use PbraidersTest\Utils\ReflectionTrait;

class ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\TemplatingEngine\ServiceProvider
     * @group specification
     */
    public function testRegister()
    {
        $pContainer = new Container();
        $pConfigProvider = new ConfigProvider();
        $pEngineProvider = new EngineProvider();

        $pConfigProvider->setContainer($pContainer);
        $pEngineProvider->setContainer($pContainer);

        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\TemplatingEngine\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pEngineProvider);

        $pConfigProvider->register();
        $pEngineProvider->register();

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pContainer->has($sProperty), 'Looking for:' . $sProperty);
        }
    }

    /**
     * @covers \Pbraiders\Service\TemplatingEngine\ServiceProvider
     * @group specification
     */
    public function testRegisterException()
    {
        $pContainer = new Container();
        $pEngineProvider = new EngineProvider();
        $pEngineProvider->setContainer($pContainer);
        $pContainer->add('settings', []);
        $this->expectException(Exception\RuntimeException::class);
        $pEngineProvider->register();
    }
}
