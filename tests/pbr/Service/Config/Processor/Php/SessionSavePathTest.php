<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Php;

use Pbraiders\Pomponne\Service\Config\Processor\Php\Session;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Php\Session
 */
class SessionSavePathTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'sessionsavepath.success.php');
        return $aData;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideFailureData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'sessionsavepath.failure.php');
        return $aData;
    }

    /**
     * @covers ::processSessionSavePath
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_processSessionSavePath_Success(array $input, array $expected)
    {
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Php\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$input]);
        $this->assertEquals($expected, $input);
    }

    /**
     * @covers ::processSessionSavePath
     * @dataProvider provideFailureData
     * @group specification
     */
    public function test_processSessionSavePath_Failure(array $input, string $expected)
    {
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Php\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $this->expectException($expected);
        $pMethod->invokeArgs($pProcessor, [&$input]);
    }
}
