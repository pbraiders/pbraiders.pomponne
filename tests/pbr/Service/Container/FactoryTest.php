<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Container;

use Pbraiders\Container\PhpDiFactory;
use Pbraiders\Pomponne\Service\Container\Factory as ContainerFactory;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Container\Factory
 */
class FactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.success.php');
        return $aData;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideFailureData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.failure.php');
        return $aData;
    }

    /**
     * @covers ::create
     * @dataProvider provideFailureData
     * @group specification
     */
    public function test_create_Failure(array $input, string $expected)
    {
        $pFactory = new ContainerFactory();
        $this->expectException($expected);
        $pFactory->create($input);
    }

    /**
     * @covers ::create
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_create_Success(array $input, string $expected)
    {
        $pFactory = new ContainerFactory();
        $pPHPDIFactory = $pFactory->create($input);
        $this->assertTrue($pPHPDIFactory instanceof $expected);
    }
}
