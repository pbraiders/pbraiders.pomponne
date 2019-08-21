<?php

namespace PbraidersTest\Container\Exception;

class ExceptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Container\Exception\BadFunctionCallException
     * @group specification
     */
    public function testBadFunctionCallException()
    {
        $this->expectException(\Pbraiders\Container\Exception\BadFunctionCallException::class);
        throw new \Pbraiders\Container\Exception\BadFunctionCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\BadMethodCallException
     * @group specification
     */
    public function testBadMethodCallException()
    {
        $this->expectException(\Pbraiders\Container\Exception\BadMethodCallException::class);
        throw new \Pbraiders\Container\Exception\BadMethodCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\DomainException
     * @group specification
     */
    public function testDomainException()
    {
        $this->expectException(\Pbraiders\Container\Exception\DomainException::class);
        throw new \Pbraiders\Container\Exception\DomainException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\InvalidArgumentException
     * @group specification
     */
    public function testInvalidArgumentException()
    {
        $this->expectException(\Pbraiders\Container\Exception\InvalidArgumentException::class);
        throw new \Pbraiders\Container\Exception\InvalidArgumentException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\LengthException
     * @group specification
     */
    public function testLengthException()
    {
        $this->expectException(\Pbraiders\Container\Exception\LengthException::class);
        throw new \Pbraiders\Container\Exception\LengthException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\OutOfBoundsException
     * @group specification
     */
    public function testOutOfBoundsException()
    {
        $this->expectException(\Pbraiders\Container\Exception\OutOfBoundsException::class);
        throw new \Pbraiders\Container\Exception\OutOfBoundsException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\OutOfRangeException
     * @group specification
     */
    public function testOutOfRangeException()
    {
        $this->expectException(\Pbraiders\Container\Exception\OutOfRangeException::class);
        throw new \Pbraiders\Container\Exception\OutOfRangeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\OverflowException
     * @group specification
     */
    public function testOverflowException()
    {
        $this->expectException(\Pbraiders\Container\Exception\OverflowException::class);
        throw new \Pbraiders\Container\Exception\OverflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\RuntimeException
     * @group specification
     */
    public function testRuntimeException()
    {
        $this->expectException(\Pbraiders\Container\Exception\RuntimeException::class);
        throw new \Pbraiders\Container\Exception\RuntimeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\UnderflowException
     * @group specification
     */
    public function testUnderflowException()
    {
        $this->expectException(\Pbraiders\Container\Exception\UnderflowException::class);
        throw new \Pbraiders\Container\Exception\UnderflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Container\Exception\UnexpectedValueException
     * @group specification
     */
    public function testUnexpectedValueException()
    {
        $this->expectException(\Pbraiders\Container\Exception\UnexpectedValueException::class);
        throw new \Pbraiders\Container\Exception\UnexpectedValueException(__METHOD__);
    }
}
