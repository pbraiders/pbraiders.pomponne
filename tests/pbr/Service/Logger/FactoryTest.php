<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Logger;

use Pbraiders\Pomponne\Service\Logger\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Logger\Factory;
use Psr\Log\LoggerInterface;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Logger\Factory
 */
class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::create
     * @uses \Pbraiders\Pomponne\Service\Logger\RotatingFileHandler
     * @uses \Pbraiders\Pomponne\Service\Logger\LineFormatter
     * @group specification
     */
    public function testCreate()
    {
        $pFactory = new Factory();
        $pErrorHandler = $pFactory->create(['service' => ['logger' => ['error_log' => '/var/log/pbraiders.log']]]);
        $this->assertTrue($pErrorHandler instanceof LoggerInterface);
    }

    /**
     * @covers ::create
     * @group specification
     */
    public function testServiceSettingException()
    {
        $pFactory = new Factory();
        $this->expectException(MissingSettingException::class);
        $pFactory->create(['no_service' => ['logger' => ['error_log' => '/var/log/pbraiders.log']]]);
    }

    /**
     * @covers ::create
     * @group specification
     */
    public function testLoggerSettingException()
    {
        $pFactory = new Factory();
        $this->expectException(MissingSettingException::class);
        $pFactory->create(['service' => ['no_logger' => ['error_log' => '/var/log/pbraiders.log']]]);
    }
}
