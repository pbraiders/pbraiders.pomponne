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
class SessionCookieDomainTest  extends \PHPUnit\Framework\TestCase
{
    use ReflectionTrait;

    /**
     * @covers ::processCookieDomain
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
     * @covers ::processCookieDomain
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
        $this->expectException(MissingSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }

    /**
     * @covers ::processCookieDomain
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
        $this->expectException(InvalidSettingException::class);
        $pMethod->invokeArgs($pProcessor, [&$aActual]);
    }
}
