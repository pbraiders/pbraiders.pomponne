<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Logger;

use Pbraiders\Pomponne\Service\Logger\StreamHandler;
use Pbraiders\Pomponne\Service\Logger\Exception;

class StreamHandlerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\StreamHandler
     * @group specification
     */
    public function testMissingSettingException()
    {
        $this->expectException(Exception\MissingSettingException::class);
        $pStreamHandler = new StreamHandler([]);
        unset($pStreamHandler);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\StreamHandler
     * @group specification
     */
    public function testInvalidSettingException()
    {
        $this->expectException(Exception\InvalidSettingException::class);
        $pStreamHandler = new StreamHandler(['error_log' => '    ']);
        unset($pStreamHandler);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\StreamHandler
     * @group specification
     */
    public function testConstructor()
    {
        $sFilename = '/var/log/pbraiders.log';
        $pStreamHandler = new StreamHandler(['error_log' => $sFilename]);
        $this->assertSame($sFilename, $pStreamHandler->getUrl());
        unset($pStreamHandler);
    }
}
