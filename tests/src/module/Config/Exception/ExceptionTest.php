<?php

namespace PbraidersTest\Config\Exception;

class ExceptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Config\Exception\BadFunctionCallException
     * @group specification
     */
    public function testBadFunctionCallException()
    {
        $this->expectException(\Pbraiders\Config\Exception\BadFunctionCallException::class);
        throw new \Pbraiders\Config\Exception\BadFunctionCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\BadMethodCallException
     * @group specification
     */
    public function testBadMethodCallException()
    {
        $this->expectException(\Pbraiders\Config\Exception\BadMethodCallException::class);
        throw new \Pbraiders\Config\Exception\BadMethodCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\DomainException
     * @group specification
     */
    public function testDomainException()
    {
        $this->expectException(\Pbraiders\Config\Exception\DomainException::class);
        throw new \Pbraiders\Config\Exception\DomainException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\InvalidArgumentException
     * @group specification
     */
    public function testInvalidArgumentException()
    {
        $this->expectException(\Pbraiders\Config\Exception\InvalidArgumentException::class);
        throw new \Pbraiders\Config\Exception\InvalidArgumentException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\LengthException
     * @group specification
     */
    public function testLengthException()
    {
        $this->expectException(\Pbraiders\Config\Exception\LengthException::class);
        throw new \Pbraiders\Config\Exception\LengthException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\OutOfBoundsException
     * @group specification
     */
    public function testOutOfBoundsException()
    {
        $this->expectException(\Pbraiders\Config\Exception\OutOfBoundsException::class);
        throw new \Pbraiders\Config\Exception\OutOfBoundsException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\OutOfRangeException
     * @group specification
     */
    public function testOutOfRangeException()
    {
        $this->expectException(\Pbraiders\Config\Exception\OutOfRangeException::class);
        throw new \Pbraiders\Config\Exception\OutOfRangeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\OverflowException
     * @group specification
     */
    public function testOverflowException()
    {
        $this->expectException(\Pbraiders\Config\Exception\OverflowException::class);
        throw new \Pbraiders\Config\Exception\OverflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\RuntimeException
     * @group specification
     */
    public function testRuntimeException()
    {
        $this->expectException(\Pbraiders\Config\Exception\RuntimeException::class);
        throw new \Pbraiders\Config\Exception\RuntimeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\UnderflowException
     * @group specification
     */
    public function testUnderflowException()
    {
        $this->expectException(\Pbraiders\Config\Exception\UnderflowException::class);
        throw new \Pbraiders\Config\Exception\UnderflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Config\Exception\UnexpectedValueException
     * @group specification
     */
    public function testUnexpectedValueException()
    {
        $this->expectException(\Pbraiders\Config\Exception\UnexpectedValueException::class);
        throw new \Pbraiders\Config\Exception\UnexpectedValueException(__METHOD__);
    }
}
