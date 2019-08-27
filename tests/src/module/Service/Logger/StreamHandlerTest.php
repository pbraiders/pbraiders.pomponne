<?php

namespace PbraidersTest\Service\Logger;

use Pbraiders\Service\Exception;
use Pbraiders\Service\Logger\StreamHandler;

class StreamHandlerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Logger\StreamHandler
     * @group specification
     */
    public function testConstructorException()
    {
        $this->expectException(Exception\InvalidArgumentException::class);
        $pStreamHandler = new StreamHandler([]);
        unset($pStreamHandler);
    }

    /**
     * @covers \Pbraiders\Service\Logger\StreamHandler
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
