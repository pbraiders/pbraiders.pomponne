<?php

namespace PbraidersTest\Application\Exception;

class ExceptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers \Pbraiders\Application\Exception\BadFunctionCallException
     * @group specification
     */
    public function testBadFunctionCallException()
    {
        $this->expectException(\Pbraiders\Application\Exception\BadFunctionCallException::class);
        throw new \Pbraiders\Application\Exception\BadFunctionCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\BadMethodCallException
     * @group specification
     */
    public function testBadMethodCallException()
    {
        $this->expectException(\Pbraiders\Application\Exception\BadMethodCallException::class);
        throw new \Pbraiders\Application\Exception\BadMethodCallException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\DomainException
     * @group specification
     */
    public function testDomainException()
    {
        $this->expectException(\Pbraiders\Application\Exception\DomainException::class);
        throw new \Pbraiders\Application\Exception\DomainException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\InvalidArgumentException
     * @group specification
     */
    public function testInvalidArgumentException()
    {
        $this->expectException(\Pbraiders\Application\Exception\InvalidArgumentException::class);
        throw new \Pbraiders\Application\Exception\InvalidArgumentException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\LengthException
     * @group specification
     */
    public function testLengthException()
    {
        $this->expectException(\Pbraiders\Application\Exception\LengthException::class);
        throw new \Pbraiders\Application\Exception\LengthException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\OutOfBoundsException
     * @group specification
     */
    public function testOutOfBoundsException()
    {
        $this->expectException(\Pbraiders\Application\Exception\OutOfBoundsException::class);
        throw new \Pbraiders\Application\Exception\OutOfBoundsException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\OutOfRangeException
     * @group specification
     */
    public function testOutOfRangeException()
    {
        $this->expectException(\Pbraiders\Application\Exception\OutOfRangeException::class);
        throw new \Pbraiders\Application\Exception\OutOfRangeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\OverflowException
     * @group specification
     */
    public function testOverflowException()
    {
        $this->expectException(\Pbraiders\Application\Exception\OverflowException::class);
        throw new \Pbraiders\Application\Exception\OverflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\RuntimeException
     * @group specification
     */
    public function testRuntimeException()
    {
        $this->expectException(\Pbraiders\Application\Exception\RuntimeException::class);
        throw new \Pbraiders\Application\Exception\RuntimeException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\UnderflowException
     * @group specification
     */
    public function testUnderflowException()
    {
        $this->expectException(\Pbraiders\Application\Exception\UnderflowException::class);
        throw new \Pbraiders\Application\Exception\UnderflowException(__METHOD__);
    }

    /**
     * @covers \Pbraiders\Application\Exception\UnexpectedValueException
     * @group specification
     */
    public function testUnexpectedValueException()
    {
        $this->expectException(\Pbraiders\Application\Exception\UnexpectedValueException::class);
        throw new \Pbraiders\Application\Exception\UnexpectedValueException(__METHOD__);
    }
}
