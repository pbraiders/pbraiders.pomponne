<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Logger;

use Pbraiders\Pomponne\Service\Logger\Exception;
use Pbraiders\Pomponne\Service\Logger\RotatingFileHandler;

class RotatingFileHandlerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\RotatingFileHandler
     * @group specification
     */
    public function testMissingSettingException()
    {
        $this->expectException(Exception\MissingSettingException::class);
        $pStreamHandler = new RotatingFileHandler([]);
        unset($pStreamHandler);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\RotatingFileHandler
     * @group specification
     */
    public function testInvalidSettingException()
    {
        $this->expectException(Exception\InvalidSettingException::class);
        $pStreamHandler = new RotatingFileHandler(['error_log' => '    ']);
        unset($pStreamHandler);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\RotatingFileHandler
     * @group specification
     */
    public function testConstructor()
    {
        $sFilename = '/var/log/pbraiders.log';
        $sExpected = sprintf('/var/log/pbraiders-%s.log', date("Y-m-d"));
        $pStreamHandler = new RotatingFileHandler(['error_log' => $sFilename]);
        $this->assertSame($sExpected, $pStreamHandler->getUrl());
        unset($pStreamHandler);
    }
}
