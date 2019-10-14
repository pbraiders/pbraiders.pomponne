<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Init;

use Pbraiders\Pomponne\Application\Init\AbstractStage;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Init\AbstractStage
 */
class AbstractStageTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers ::setNext
     * @group specification
     */
    public function testSetNext()
    {
        $pStub = $this->getMockForAbstractClass(AbstractStage::class);
        $pProperty = $this->getProperty('\Pbraiders\Pomponne\Application\Init\AbstractStage', 'pNextStage');
        $pExpected = new DoNothingStage();
        $pActual = $pStub->setNext($pExpected);
        $this->assertSame($pExpected, $pActual);
        $pActual = $pProperty->getValue($pStub);
        $this->assertSame($pExpected, $pActual);
    }

    /**
     * @covers ::initialize
     * @uses \Pbraiders\Pomponne\Application\Init\AbstractStage::setNext
     * @group specification
     */
    public function testInitialize()
    {
        $pStub = $this->getMockForAbstractClass(AbstractStage::class);
        $pStub->setNext(new DoNothingStage());
        $pActual = $pStub->initialize(new DoNothingFactory());
        $this->assertNull($pActual);
    }
}
