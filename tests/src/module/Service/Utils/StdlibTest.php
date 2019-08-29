<?php

namespace PbraidersTest\Service\Utils;

use Pbraiders\Service\Utils\Stdlib;

class StdlibTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testConfigurePHP()
    {
        $sInitial = @ini_get('error_log');
        $sExpected = sprintf('%s/log/%s_pbraiders_error.log', \PBR_PATH, date("Ymd"));
        $pStdlib = new Stdlib();
        $bReturn = $pStdlib->configurePHP(['error_log' => $sExpected]);
        $sActual = @ini_get('error_log');
        $this->assertTrue($bReturn);
        $this->assertSame($sExpected, $sActual);
        @ini_set('error_log', $sInitial);
    }

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testSortArrayByKey()
    {
        $aExpected = [
            'a' => [
                'x' => 1,
                'y' => [
                    'g' => 1,
                    'h' => 1,
                    'i' => 1,
                ],
                'z' => 1,
            ],
            'b' => 1,
            'c' => [
                'k' => 1,
                'm' => 1,
            ],
        ];
        $aActual = [
            'c' => [
                'm' => 1,
                'k' => 1,
            ],
            'a' => [
                'z' => 1,
                'x' => 1,
                'y' => [
                    'h' => 1,
                    'g' => 1,
                    'i' => 1,
                ],
            ],
            'b' => 1,
        ];
        Stdlib::sortArrayByKey($aActual);
        $this->assertSame($aExpected, $aActual);
    }
}
