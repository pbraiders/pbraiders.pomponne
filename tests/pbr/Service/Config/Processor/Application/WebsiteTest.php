<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Application;

use Pbraiders\Pomponne\Service\Config\Processor\Application\Website;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Application\Website
 */
class WebsiteTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'website.success.php');
        return $aData;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideFailureData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'website.failure.php');
        return $aData;
    }

    /**
     * @covers ::process
     * @dataProvider provideFailureData
     * @group specification
     */
    public function test_process_Failure(array $input, string $expected)
    {
        $pProcessor = new Website();
        $this->expectException($expected);
        $pProcessor->process($input);
    }

    /**
     * @covers ::process
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_process_Success(array $input, array $expected)
    {
        $pProcessor = new Website();
        $aActual = $pProcessor->process($input);
        $this->assertEquals($expected, $aActual);
    }
}
