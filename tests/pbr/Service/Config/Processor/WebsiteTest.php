<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Processor;

use Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException;
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Config\Processor\Website;

class WebsiteTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Website
     * @group specification
     */
    public function testProcessMissing()
    {
        $aSettings = [
            'application' => [
                'website' => [
                    'noturl' => 'https://www.pbraiders.fr/v2/',
                ],
            ],
        ];

        $pProcessor = new Website();
        $this->expectException(MissingSettingException::class);
        $pProcessor->process($aSettings);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Website
     * @group specification
     */
    public function testProcessNotValid()
    {
        $aSettings = [
            'application' => [
                'website' => [
                    'url' => '   ',
                ],
            ],
        ];

        $pProcessor = new Website();
        $this->expectException(InvalidSettingException::class);
        $pProcessor->process($aSettings);
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Processor\Website
     * @group specification
     */
    public function testProcess()
    {
        $aSettings = [
            'application' => [
                'website' => [
                    'url' => 'https://www.pbraiders.fr/v2/',
                ],
            ],
        ];

        $aExpected = [
            'application' => [
                'website' => [
                    'url' => 'https://www.pbraiders.fr/v2/',
                    'scheme' => 'https',
                    'user' => null,
                    'pass' => null,
                    'host' => 'www.pbraiders.fr',
                    'port' => null,
                    'path' => '/v2/',
                    'query' => null,
                    'fragment' => null,
                ],
            ],
        ];

        $pProcessor = new Website();
        $aActual = $pProcessor->process($aSettings);
        $this->assertEquals($aExpected, $aActual);
    }
}
