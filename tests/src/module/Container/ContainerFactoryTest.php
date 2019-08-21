<?php

namespace PbraidersTest\Container;

class ContainerFactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Container\ContainerFactory
     * @group specification
     */
    public function testCreateInvokables()
    {
        $aInvokables = [
            '\PbraidersTest\Container\ServiceProvider',
        ];

        $pContainer = \Pbraiders\Container\ContainerFactory::createInvokables($aInvokables);

        $this->assertTrue($pContainer->has('service1'));
        $this->assertTrue($pContainer->has('service2'));
    }

    /**
     * @covers \Pbraiders\Container\ContainerFactory
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

        $pContainer = \Pbraiders\Container\ContainerFactory::createFactories($aFactories);

        $this->assertTrue($pContainer->has('service1'));
        $this->assertTrue($pContainer->has('service2'));
    }
}
