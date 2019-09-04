<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Config;

use Pbraiders\Service\Exception;
use Pbraiders\Service\Config\Factory;
use PbraidersTest\Utils\ReflectionTrait;

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;
    /**
     * Main config filename.
     *
     * @var string DEFAULT_FILENAME_MAIN
     */
    const DEFAULT_FILENAME_MAIN = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'config.php';

    /**
     * Local config filename
     *
     * @var string DEFAULT_FILENAME_LOCAL
     */
    const DEFAULT_FILENAME_LOCAL = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'local.config.php';

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testCreate()
    {
        $pFactory = new Factory();
        $aSettings = $pFactory->create(static::DEFAULT_FILENAME_MAIN, static::DEFAULT_FILENAME_LOCAL);
        $this->assertTrue(is_array($aSettings));
        $this->assertFalse(empty($aSettings['application']['website']['path']));
        $this->assertSame('/v2.0.0/', $aSettings['application']['website']['path']);
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testCreateException()
    {
        $sMainConfigFilename = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'nowebsite.config.php';
        $sLocalConfigFilename = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'local.nowebsite.config.php';
        $pFactory = new Factory();
        $this->expectException(Exception\RuntimeException::class);
        $pFactory->create($sMainConfigFilename, $sLocalConfigFilename);
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadMainConfigEmpty()
    {
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readMainConfig');
        $aActual = $pMethod->invoke($pFactory, '    ');
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadMainConfigDoesNotExists()
    {
        $sFilename = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'doesnotexist.php';
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readMainConfig');
        $this->expectException(Exception\RuntimeException::class);
        $pMethod->invoke($pFactory, $sFilename);
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadMainConfig()
    {
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readMainConfig');
        $aActual = $pMethod->invoke($pFactory);
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadLocalConfigEmpty()
    {
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readLocalConfig');
        $aActual = $pMethod->invoke($pFactory, '    ');
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadLocalConfigDoesNotExists()
    {
        $sFilename = \PBR_PATH . \DIRECTORY_SEPARATOR . 'config' . \DIRECTORY_SEPARATOR . 'doesnotexist.php';
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readLocalConfig');
        $aActual = $pMethod->invoke($pFactory, $sFilename);
        $this->assertTrue(is_array($aActual));
        $this->assertTrue(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testReadLocalConfig()
    {
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'readLocalConfig');
        $aActual = $pMethod->invoke($pFactory);
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testUpdateSessionSettingsException()
    {
        $aExpected = [
            'application' => [],
        ];
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'updateSessionSettings');
        $this->expectException(Exception\RuntimeException::class);
        $pMethod->invokeArgs($pFactory, [&$aExpected]);
    }

    /**
     * @covers \Pbraiders\Service\Config\Factory
     * @group specification
     */
    public function testUpdateSessionSettings()
    {
        $aSettings = [
            'application' => [
                'website' => [
                    'host' => 'www.domain.tld',
                    'scheme' => 'https',
                ],
                'temporary_path' => '/tmp',
            ],
            'php' => [],
        ];
        $pFactory = new Factory();
        $pMethod = $this->getPrivateMethod('\Pbraiders\Service\Config\Factory', 'updateSessionSettings');
        $pMethod->invokeArgs($pFactory, [&$aSettings]);
        $this->assertFalse(empty($aSettings['php']['session.cookie_domain']));
        $this->assertSame('www.domain.tld', $aSettings['php']['session.cookie_domain']);
        $this->assertFalse(empty($aSettings['php']['session.save_path']));
        $this->assertSame('/tmp', $aSettings['php']['session.save_path']);
        $this->assertFalse(empty($aSettings['php']['session.cookie_secure']));
        $this->assertSame('1', $aSettings['php']['session.cookie_secure']);
    }
}
