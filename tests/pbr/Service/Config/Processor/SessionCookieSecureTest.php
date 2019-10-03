<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Config\Processor\Session;
use Pbraiders\Stdlib\ReflectionTrait;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Session
 */
class SessionCookieSecureTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers ::processCookieSecure
     * @group specification
     */
    public function testProcessCookieSecure()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ];
        $aExpected = [
            'application' => [
                'website' => [
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '1',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * @covers ::processCookieSecure
     * @group specification
     */
    public function testProcessCookieNotSecure()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'scheme' => 'http',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '1',
            ],
        ];
        $aExpected = [
            'application' => [
                'website' => [
                    'scheme' => 'http',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * @covers ::processCookieSecure
     * @group specification
     */
    public function testProcessCookieSecureMissing()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'noscheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $this->expectException(MissingSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers ::processCookieSecure
     * @group specification
     */
    public function testProcessCookieSecureNotValid()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'scheme' => 'ftp',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieSecure');
        $pProcessor = new Session();
        $this->expectException(InvalidSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }
}
