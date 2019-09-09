<?php

namespace PbraidersTest\Service\Utils\Stdlib;

class ExistsDepthKeyInArrayTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testExistsDepthKeyInArrayTrue()
    {
        $aActual = [
            'a' => 'a',
            'b' => [
                'c' => 'c',
                'e' => [
                    'f' => 'f',
                    'g' => 'g',
                ],
                'd' => 'd',
            ],
            'h' => 'h',
        ];

        $aFilter = [
            'b' => [
                'e' => [
                    'f' => 'f',
                ],
            ],
        ];

        $aReturn = \Pbraiders\Service\Utils\Stdlib\existsDepthKeyInArray($aActual, $aFilter);
        $this->assertTrue($aReturn);
    }

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testExistsDepthKeyInArrayFalse()
    {
        $aActual = [
            'a' => 'a',
            'b' => [
                'c' => 'c',
                'e' => [
                    'f' => 'f',
                    'g' => 'g',
                ],
                'd' => 'd',
            ],
            'h' => 'h',
        ];

        $aFilter = [
            'b' => [
                'h' => 'h',
            ],
        ];

        $aReturn = \Pbraiders\Service\Utils\Stdlib\existsDepthKeyInArray($aActual, $aFilter);
        $this->assertFalse($aReturn);
    }
}
