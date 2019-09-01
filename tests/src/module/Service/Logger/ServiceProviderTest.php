<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Logger;

use League\Container\Container;
use Pbraiders\Service\Logger\ServiceProvider;
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
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\Logger\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pServiceProvider);

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pServiceProvider->provides($sProperty));
        }
    }
}
