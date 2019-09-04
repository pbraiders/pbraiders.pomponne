<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Utils;

use League\Container\Container;
use Pbraiders\Service\Utils\ServiceProvider;
use PbraidersTest\Utils\ReflectionTrait;

class ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\Utils\ServiceProvider
     * @group specification
     */
    public function testRegister()
    {
        $pServiceProvider = new ServiceProvider();
        $pContainer = new Container();
        $pServiceProvider->setContainer($pContainer);
        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\Utils\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pServiceProvider);
        $pServiceProvider->register();

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pContainer->has($sProperty), 'Looking for:' . $sProperty);
        }
    }
}
