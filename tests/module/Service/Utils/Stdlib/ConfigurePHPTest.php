<?php

namespace PbraidersTest\Service\Utils\Stdlib;

class ConfigurePHPTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testConfigurePHP()
    {
        $sInitial = @ini_get('error_log');
        $sExpected = sprintf('%s/log/%s_pbraiders_error.log', \PBR_PATH, date("Ymd"));
        $bReturn = \Pbraiders\Service\Utils\Stdlib\configurePHP(['error_log' => $sExpected]);
        $sActual = @ini_get('error_log');
        $this->assertTrue($bReturn);
        $this->assertSame($sExpected, $sActual);
        @ini_set('error_log', $sInitial);
    }
}
