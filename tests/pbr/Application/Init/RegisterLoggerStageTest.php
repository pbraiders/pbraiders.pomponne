<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Init;

use Pbraiders\Pomponne\Application\Init\RegisterLoggerStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Init\RegisterLoggerStage
 */
class RegisterLoggerStageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::initialize
     * @uses Pbraiders\Pomponne\Application\Init\AbstractStage::initialize
     * @group specification
     */
    public function testInitialize()
    {
        $pStage = new RegisterLoggerStage();
        $pActual = $pStage->initialize(new DoNothingFactory());
        $this->assertNull($pActual);
    }
}
