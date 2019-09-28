<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInitException()
    {
        $this->expectException(InvalidWorkingDirectoryException::class);
        Application::init('     ');
    }

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInitAndBootstrap()
    {
        $sDir = getcwd();
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pInit = Application::init($sDir);
        $this->assertTrue($pInit instanceof Application);
        $pApp = $pInit->bootstrap();
        $this->assertTrue($pApp instanceof Application);
    }
}
