<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Php;

use Pbraiders\Pomponne\Service\Config\Processor\Service\Logger;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Service\Logger
 */
class LoggerTest  extends \PHPUnit\Framework\TestCase
{

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'logger.success.php');
        return $aData;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideFailureData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'logger.failure.php');
        return $aData;
    }

    /**
     * @covers ::process
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_process_Success(array $input, array $expected)
    {
        $pProcessor = new Logger();
        $aActual = $pProcessor->process($input);
        $this->assertEquals($expected, $aActual);
    }

    /**
     * @covers ::process
     * @dataProvider provideFailureData
     * @group specification
     */
    public function test_process_Failure(array $input, string $expected)
    {
        $pProcessor = new Logger();
        $this->expectException($expected);
        $aActual = $pProcessor->process($input);
    }
}
