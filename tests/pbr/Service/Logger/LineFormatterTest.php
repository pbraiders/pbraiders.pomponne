<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Logger;

use Pbraiders\Pomponne\Service\Logger\LineFormatter;

class LineFormatterTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Pomponne\Service\Logger\LineFormatter
     * @group specification
     */
    public function testConstructor()
    {
        $aData = [
            'level_name' => 'WARNING',
            'channel' => 'pbraiderstest',
            'context' => [],
            'message' => 'Test Pbraiders\Service\Logger\LineFormatter',
            'datetime' => new \DateTimeImmutable,
            'extra' => [
                'ip' => '127.0.0.1',
                'user' => 'olivier',
                'http_method' => 'GET',
                'url' => 'https://www.pbraiders.fr/v2/',
                'referrer' => 'phpunit',
            ],
        ];
        $pLineFormatter = new LineFormatter();
        $sMessageActual = $pLineFormatter->format($aData);
        $this->assertFalse(strlen($sMessageActual) == 0);
    }
}
