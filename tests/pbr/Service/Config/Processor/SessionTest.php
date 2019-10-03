<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Processor\Session;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Service\Config\Processor\Session
 */
class SessionTest  extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::process
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processCookieDomain
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processSessionSavePath
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session::processCookieSecure
     * @group specification
     */
    public function testProcess()
    {
        $aSettings = [
            'application' => [
                'temporary_path' => __DIR__,
                'website' => [
                    'host' => 'www.domain.tld',
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
                'session.cookie_secure' => '0',
                'session.save_path' => '',
            ],
        ];
        $aExpected = [
            'application' => [
                'temporary_path' => __DIR__,
                'website' => [
                    'host' => 'www.domain.tld',
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_domain' => 'www.domain.tld',
                'session.cookie_secure' => '1',
                'session.save_path' => __DIR__,
            ],
        ];
        $pProcessor = new Session();
        $aActual = $pProcessor->process($aSettings);
        $this->assertEquals($aExpected, $aActual);
    }
}
