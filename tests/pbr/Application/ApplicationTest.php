<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception\WorkingDirNotValidException;
use Pbraiders\Pomponne\Service\Config\Exception\DirectoryNotExistNorWritableException;

class ApplicationTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInitException()
    {
        $this->expectException(WorkingDirNotValidException::class);
        Application::init('     ');
    }

    /**
     * @covers \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInit()
    {
        $sDir = getcwd();
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pApp = Application::init($sDir);
        $this->assertTrue($pApp instanceof Application);
    }
}
