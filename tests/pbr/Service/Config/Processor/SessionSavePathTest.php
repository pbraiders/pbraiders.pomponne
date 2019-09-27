<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException;
use Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Config\Processor\Session;
use Pbraiders\Stdlib\ReflectionTrait;

class SessionSavePathTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testprocessSessionSavePath()
    {
        $aActual = [
            'application' => [
                'temporary_path' => __DIR__,
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ];
        $aExpected = [
            'application' => [
                'temporary_path' => __DIR__,
            ],
            'php' => [
                'session.save_path' => __DIR__,
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testprocessSessionSavePathMissing()
    {
        $aActual = [
            'application' => [
                'notemporary_path' => __DIR__,
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $this->expectException(MissingSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testprocessSessionSavePathNotValid()
    {
        $aActual = [
            'application' => [
                'temporary_path' => '       ',
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $this->expectException(InvalidSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testprocessSessionSavePathNotDir()
    {
        $aActual = [
            'application' => [
                'temporary_path' => __FILE__,
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processSessionSavePath');
        $pProcessor = new Session();
        $this->expectException(InvalidAccessPermissionException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }
}
