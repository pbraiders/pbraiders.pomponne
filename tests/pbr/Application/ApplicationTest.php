<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Bootstrap\DoNothing as BootstrapDoNothing;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;
use Pbraiders\Pomponne\Application\Initializer\Simple;
use Pbraiders\Pomponne\Application\Run\DoNothing as RunDoNothing;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInitException()
    {
        $pInitializer = new Simple();
        $pInitializer->setWorkingDir('       ');
        $this->expectException(InvalidWorkingDirectoryException::class);
        Application::init($pInitializer);
    }

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInitBootstrapAndRun()
    {
        $sDir = getcwd();
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pBootstrap = new BootstrapDoNothing();
        $pRun = new RunDoNothing();
        $pInitializer = new Simple();
        $pInitializer->setWorkingDir($sDir);
        $pApplication = Application::init($pInitializer);
        $pApplication->bootstrap($pBootstrap)->run($pRun);
        $this->assertTrue($pApplication instanceof Application);
    }
}
