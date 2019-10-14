<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Init;

use Pbraiders\Pomponne\Application\Init\SlimBridgeStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Init\SlimBridgeStage
 */
class SlimBridgeStageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::initialize
     * @group specification
     */
    public function testInitialize()
    {
        $pStage = new SlimBridgeStage();
        $pActual = $pStage->initialize(new DoNothingFactory());
        $this->assertTrue($pActual instanceof \Slim\App);
    }
}
