<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;
use Pbraiders\Pomponne\Application\Initializer\Main;

class MainTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Pomponne\Application\Initializer\Initializer
     * @covers \Pbraiders\Pomponne\Application\Initializer\Main
     * @group specification
     */
    public function testInitializeException()
    {
        $this->expectException(InvalidWorkingDirectoryException::class);
        $pInitializer = new Main();
        $pInitializer
            ->setWorkingDir('     ')
            ->initialize();
    }

    /**
     * @covers \Pbraiders\Pomponne\Application\Initializer\Main
     * @group specification
     */
    public function testInit()
    {
        $sDir = getcwd();
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pInitializer = new Main();
        $pApplication = $pInitializer
            ->setWorkingDir($sDir)
            ->initialize();
        $this->assertTrue($pApplication instanceof Application);
    }
}
