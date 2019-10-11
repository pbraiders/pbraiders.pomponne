<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Application\Bootstrap\PHPStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\PHPStage
 */
class PHPStageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::boot
     * @group specification
     */
    public function testBootException()
    {
        $pStage = new PHPStage();
        $this->expectException(MissingSettingException::class);
        $pStage->boot(['no_php_section' => false]);
    }

    /**
     * @covers ::boot
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage
     * @group specification
     */
    public function testBoot()
    {
        $sExpected = '/var/log/pbraiders/modified';
        $pStage = new PHPStage();
        $pStage->boot(['php' => ['error_log' => $sExpected]]);
        $sActual = @ini_get('error_log');
        $this->assertSame($sExpected, $sActual);
    }
}
