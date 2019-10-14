<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\AbstractStage;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage
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
        $pProperty = $this->getProperty('\Pbraiders\Pomponne\Application\Bootstrap\AbstractStage', 'pNextStage');
        $pExpected = new DoNothingStage();
        $pActual = $pStub->setNext($pExpected);
        $this->assertSame($pExpected, $pActual);
        $pActual = $pProperty->getValue($pStub);
        $this->assertSame($pExpected, $pActual);
    }

    /**
     * @covers ::boot
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::setNext
     * @group specification
     */
    public function testBoot()
    {
        $pStub = $this->getMockForAbstractClass(AbstractStage::class);
        $pStub->setNext(new DoNothingStage());
        $pActual = $pStub->boot([]);
        $this->assertNull($pActual);
    }
}
