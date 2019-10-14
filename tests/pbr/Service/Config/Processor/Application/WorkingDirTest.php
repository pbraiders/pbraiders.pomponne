<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor\Application;

use Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException;
use Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir
 */
class WorkingDirTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers ::setWorkingDir
     * @group specification
     */
    public function test_setWorkingDir_Failure()
    {
        $pProcessor = new WorkingDir();
        $this->expectException(InvalidSettingException::class);
        $pProcessor->setWorkingDir('     ');
    }

    /**
     * @covers ::setWorkingDir
     * @group specification
     */
    public function test_setWorkingDir_Success()
    {
        $sExpected = '/var/www/pbraiders';
        $pProperty = $this->getProperty('\Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir', 'sWorkingDir');
        $pProcessor = new WorkingDir();
        $pProcessor->setWorkingDir($sExpected);
        $sActual = $pProperty->getValue($pProcessor);
        $this->assertSame($sExpected, $sActual);
    }

    /**
     * @covers ::process
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir::setWorkingDir
     * @group specification
     */
    public function test_process_Success()
    {
        $sExpected = '/var/www/pbraiders';
        $pProcessor = new WorkingDir();
        $pProcessor->setWorkingDir($sExpected);
        $aActual = $pProcessor->process([]);
        $this->assertSame($sExpected, $aActual['application']['working_directory']);
    }
}
