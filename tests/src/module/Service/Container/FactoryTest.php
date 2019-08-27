<?php

namespace PbraidersTest\Service\Container;

use Pbraiders\Service\Container\Factory;
use PbraidersTest\Service\Container\ServiceProvider;

class FactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Container\Factory
     * @group specification
     */
    public function testCreateInvokables()
    {
        $aInvokables = [
            ServiceProvider::class,
        ];

        $pContainer = Factory::createFromInvokables($aInvokables);

        $this->assertTrue($pContainer->has('service1'));
        $this->assertTrue($pContainer->has('service2'));
    }

    /**
     * @covers \Pbraiders\Service\Container\Factory
     * @group specification
     */
    public function testcreateFactories()
    {
        $aFactories = [
            'service1' => static function (\Psr\Container\ContainerInterface $container) {
                return $container;
            },
            'service2' => static function (\Psr\Container\ContainerInterface $container) {
                return $container;
            },
        ];

        $pContainer = Factory::createFromFactories($aFactories);

        $this->assertTrue($pContainer->has('service1'));
        $this->assertTrue($pContainer->has('service2'));
    }
}
