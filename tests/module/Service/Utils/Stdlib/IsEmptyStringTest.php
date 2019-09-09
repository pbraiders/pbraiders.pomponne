<?php

namespace PbraidersTest\Service\Utils\Stdlib;

class IsEmptyStringTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testIsEmptyStringEmpty()
    {
        $bReturn = \Pbraiders\Service\Utils\Stdlib\isEmptyString('');
        $this->assertTrue($bReturn);
    }

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testIsEmptyStringSpace()
    {
        $bReturn = \Pbraiders\Service\Utils\Stdlib\isEmptyString('   ');
        $this->assertTrue($bReturn);
    }

    /**
     * @covers \Pbraiders\Service\Utils\Stdlib
     * @group specification
     */
    public function testIsEmptyStringNo()
    {
        $bReturn = \Pbraiders\Service\Utils\Stdlib\isEmptyString('hello');
        $this->assertFalse($bReturn);
    }
}
