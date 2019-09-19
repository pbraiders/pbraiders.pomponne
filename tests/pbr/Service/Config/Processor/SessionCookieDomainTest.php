<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Processor\Session;
use Pbraiders\Stdlib\ReflectionTrait;

class SessionCookieDomainTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testProcessCookieDomain()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'host' => 'www.domain.tld',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ];
        $aExpected = [
            'application' => [
                'website' => [
                    'host' => 'www.domain.tld',
                ],
            ],
            'php' => [
                'session.cookie_domain' => 'www.domain.tld',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieDomain');
        $pProcessor = new Session();
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
        $this->assertEquals($aExpected, $aActual);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testProcessCookieDomainMissing()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'nohost' => 'www.domain.tld',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieDomain');
        $pProcessor = new Session();
        $this->expectException(\RuntimeException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @group specification
     */
    public function testProcessCookieDomainNotValid()
    {
        $aActual = [
            'application' => [
                'website' => [
                    'host' => '   ',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ];
        $pMethod = $this->getMethod('\Pbraiders\Pomponne\Service\Config\Processor\Session', 'processCookieDomain');
        $pProcessor = new Session();
        $this->expectException(\RuntimeException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }
}
