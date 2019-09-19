<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Processor\Session;
use Pbraiders\Stdlib\ReflectionTrait;

class SessionCookieSecureTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
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
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
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
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
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
        $this->expectException(\RuntimeException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
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
        $this->expectException(\RuntimeException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }
}
