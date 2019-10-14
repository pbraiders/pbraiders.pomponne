<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Php;

use Pbraiders\Pomponne\Service\Config\Processor\Php\Session;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Php\Session
 */
class SessionCookieSecureTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'sessioncookiesecure.success.php');
        return $aData;
    }

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideFailureData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'sessioncookiesecure.failure.php');
        return $aData;
    }

    /**
     * @covers ::processCookieSecure
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_processCookieSecure_Success(array $input, array $expected)
    {
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Php\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$input]);
        $this->assertEquals($expected, $input);
    }

    /**
     * @covers ::processCookieSecure
     * @dataProvider provideFailureData
     * @group specification
     */
    public function test_processCookieSecure_Failure(array $input, string $expected)
    {
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Php\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $this->expectException($expected);
        $pMethod->invokeArgs($pProcessor, [&$input]);
    }
}
