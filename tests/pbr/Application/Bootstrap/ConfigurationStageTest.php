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
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::boot
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::setNext
     * @uses \Pbraiders\Pomponne\Service\Config\Factory::create
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::process
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processCookieDomain
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processCookieSecure
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processSessionSavePath
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Website::process
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
