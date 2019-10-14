<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Init;

use Pbraiders\Pomponne\Application\Init\SlimStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Init\SlimStage
 */
class SlimStageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::initialize
     * @group specification
     */
    public function testInitialize()
    {
        $pStage = new SlimStage();
        $pActual = $pStage->initialize(new DoNothingFactory());
        $this->assertTrue($pActual instanceof \Slim\App);
    }
}
