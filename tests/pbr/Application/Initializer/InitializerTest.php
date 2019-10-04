<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Initializer\Initializer;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Initializer\Initializer
 */
class InitializerTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers ::setWorkingDir
     * @group specification
     */
    public function testSetWorkingDir()
    {
        $pStub = $this->getMockForAbstractClass(Initializer::class);
        $pProperty = $this->getProperty('\Pbraiders\Pomponne\Application\Initializer\Initializer', 'sWorkingDir');
        $sActual = $pProperty->getValue($pStub);
        $this->assertNull($sActual);
        $sExpected = 'here';
        $pStub->setWorkingDir($sExpected);
        $sActual = $pProperty->getValue($pStub);
        $this->assertSame($sExpected, $sActual);
    }
}
