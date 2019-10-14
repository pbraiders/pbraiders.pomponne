<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Php;

use Pbraiders\Pomponne\Service\Config\Processor\Php\Session;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Php\Session
 */
class SessionTest  extends \PHPUnit\Framework\TestCase
{

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'session.success.php');
        return $aData;
    }

    /**
     * @covers ::process
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processCookieDomain
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processSessionSavePath
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processCookieSecure
     * @dataProvider provideSucessData
     * @group specification
     */
    public function test_process_Success(array $input, array $expected)
    {
        $pProcessor = new Session();
        $aActual = $pProcessor->process($input);
        $this->assertEquals($expected, $aActual);
    }
}
