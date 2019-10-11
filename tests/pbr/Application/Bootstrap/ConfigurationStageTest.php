<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\ConfigurationStage;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\ConfigurationStage
 */
class ConfigurationStageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::boot
     * @group specification
     */
    public function testBootException()
    {
        $pStage = new ConfigurationStage();
        $this->expectException(InvalidWorkingDirectoryException::class);
        $pStage->boot(['application' => ['working_directory' => false]]);
    }

    /**
     * @covers ::boot
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage
     * @uses \Pbraiders\Pomponne\Service\Config\Factory
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\php\Session
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\Website
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\CachePath
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\TemporaryPath
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\ErrorLog
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Service\Logger
     * @group specification
     */
    public function testBoot()
    {
        $sWorkingDir = getcwd();
        $this->assertFalse((FALSE === $sWorkingDir));
        $sWorkingDir .= \DIRECTORY_SEPARATOR . 'tests';

        $pCatch = new DoNothingStage();
        $pStage = new ConfigurationStage();
        $pStage->setNext($pCatch);

        $pStage->boot(['application' => ['working_directory' => $sWorkingDir]]);

        $this->assertTrue(isset($pCatch->aSettings['application']) && is_array($pCatch->aSettings['application']));
        $this->assertTrue(isset($pCatch->aSettings['application']['working_directory']));
        $this->assertSame($sWorkingDir, $pCatch->aSettings['application']['working_directory']);
    }
}
