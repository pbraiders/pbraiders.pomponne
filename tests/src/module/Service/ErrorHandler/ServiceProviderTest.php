<?php

declare(strict_types=1);

namespace PbraidersTest\Service\ErrorHandler;

use League\Container\Container;
use Pbraiders\Service\ErrorHandler\ServiceProvider;
use PbraidersTest\Utils\ReflectionTrait;

class ServiceProviderTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\ErrorHandler\ServiceProvider
     * @group specification
     */
    public function testRegister()
    {
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\ErrorHandler\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pServiceProvider);

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pServiceProvider->provides($sProperty));
        }
    }
}
