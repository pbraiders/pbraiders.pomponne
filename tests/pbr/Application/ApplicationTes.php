<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Bootstrap\DoNothing as BootstrapDoNothing;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;
use Pbraiders\Pomponne\Application\Initializer\Simple;
use Pbraiders\Pomponne\Application\Run\DoNothing as RunDoNothing;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Application
 */
class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::init
     * @uses \Pbraiders\Pomponne\Application\Initializer\Simple
     * @uses \Pbraiders\Pomponne\Application\Initializer\Initializer
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
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\DoNothing
     * @uses \Pbraiders\Pomponne\Application\Run\DoNothing
     * @uses \Pbraiders\Pomponne\Service\Config\Factory
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Website
     * @uses \Pbraiders\Pomponne\Service\Container\Factory
     * @uses \Pbraiders\Pomponne\Application\Initializer\Initializer
     * @uses \Pbraiders\Pomponne\Application\Initializer\Simple
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
