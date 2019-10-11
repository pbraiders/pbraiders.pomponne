<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config;

use Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException;
use Pbraiders\Pomponne\Service\Config\Factory;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Factory
 */
class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::create
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\Website
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\CachePath
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\TemporaryPath
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Service\Logger
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Php\ErrorLog
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Php\Session
     * @group specification
     */
    public function testCreate()
    {
        $sDir = getcwd();
        if (FALSE === $sDir) {
            exit(33);
        }
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pFactory = new Factory();
        $aActual = $pFactory->create($sDir);
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers ::create
     * @group specification
     */
    public function testCreateException()
    {
        $pFactory = new Factory();
        $this->expectException(InvalidAccessPermissionException::class);
        $pFactory->create('doesnotexists');
    }
}
