<?php

namespace PbraidersTest\Service\Config;

use Pbraiders\Service\Exception;
use Pbraiders\Service\Config\Factory;

class FactoryTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Main config filename.
     *
     * @var string
     */
    const DEFAULT_FILENAME_MAIN = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'config.php';

    /**
     * Local config filename
     *
     * @var string
     */
    const DEFAULT_FILENAME_LOCAL = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'localconfig.php';

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testCreateMainException()
    {
        $sFilename = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'doesnotexist.php';
        $this->expectException(Exception\RuntimeException::class);
        Factory::create($sFilename);
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testCreate()
    {
        $aSettings = Factory::create(static::DEFAULT_FILENAME_MAIN, static::DEFAULT_FILENAME_LOCAL);
        $this->assertTrue(is_array($aSettings));
        $this->assertFalse(empty($aSettings['website']['path']));
        $this->assertSame('/v2.0.0/', $aSettings['website']['path']);
    }
}
