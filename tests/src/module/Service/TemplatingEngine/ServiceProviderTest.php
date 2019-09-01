<?php

declare(strict_types=1);

namespace PbraidersTest\Service\TemplatingEngine;

use League\Container\Container;
use Pbraiders\Service\TemplatingEngine\ServiceProvider;
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
        $pServiceProvider = new ServiceProvider();
        $pServiceProvider->setContainer(new Container());
        $pProperty = $this->getPrivateProperty('\Pbraiders\Service\TemplatingEngine\ServiceProvider', 'provides');
        $aProperties = $pProperty->getValue($pServiceProvider);

        foreach ($aProperties as $sProperty) {
            $this->assertTrue($pServiceProvider->provides($sProperty));
        }
    }
}
