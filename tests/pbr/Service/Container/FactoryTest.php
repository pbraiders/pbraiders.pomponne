<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Container;

use Pbraiders\Container\PhpDiFactory;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactory;

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Pomponne\Service\Container\Factory
     * @group specification
     */
    public function testCreate()
    {
        $aData = [
            'application' => [
                'cache_path' => sprintf('%s/var/cache', getcwd()),
            ],
            'service' => [
                'container' => [
                    'enable_compilation' => false,
                    'write_proxies_to_file' => false
                ],
            ],
        ];
        $pFactory = new ContainerFactory();
        $pPHPDIFactory = $pFactory->create($aData);
        $this->assertTrue($pPHPDIFactory instanceof PhpDiFactory);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Container\Factory
     * @group specification
     */
    public function testCachePathException()
    {
        $aData = [
            'application' => [],
            'service' => [
                'container' => [
                    'enable_compilation' => true,
                    'write_proxies_to_file' => true
                ],
            ],
        ];
        $pFactory = new ContainerFactory();
        $this->expectException(MissingSettingException::class);
        $pFactory->create($aData);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Container\Factory
     * @group specification
     */
    public function testCompilationException()
    {
        $aData = [
            'application' => [
                'cache_path' => 'here',
            ],
            'service' => [
                'container' => [
                    'write_proxies_to_file' => true
                ],
            ],
        ];
        $pFactory = new ContainerFactory();
        $this->expectException(MissingSettingException::class);
        $pFactory->create($aData);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Container\Factory
     * @group specification
     */
    public function testProxyException()
    {
        $aData = [
            'application' => [
                'cache_path' => 'here',
            ],
            'service' => [
                'container' => [
                    'enable_compilation' => true,
                ],
            ],
        ];
        $pFactory = new ContainerFactory();
        $this->expectException(MissingSettingException::class);
        $pFactory->create($aData);
    }
}
