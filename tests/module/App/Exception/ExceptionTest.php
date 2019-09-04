<?php

declare(strict_types=1);

namespace PbraidersTest\App\Exception;

use Pbraiders\App\Exception;

class ExceptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers Pbraiders\App\Exception\BadFunctionCallException
     * @group specification
     */
    public function testBadFunctionCallException()
    {
        $this->expectException(Exception\BadFunctionCallException::class);
        throw new Exception\BadFunctionCallException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\BadMethodCallException
     * @group specification
     */
    public function testBadMethodCallException()
    {
        $this->expectException(Exception\BadMethodCallException::class);
        throw new Exception\BadMethodCallException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\DomainException
     * @group specification
     */
    public function testDomainException()
    {
        $this->expectException(Exception\DomainException::class);
        throw new Exception\DomainException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\InvalidArgumentException
     * @group specification
     */
    public function testInvalidArgumentException()
    {
        $this->expectException(Exception\InvalidArgumentException::class);
        throw new Exception\InvalidArgumentException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\LengthException
     * @group specification
     */
    public function testLengthException()
    {
        $this->expectException(Exception\LengthException::class);
        throw new Exception\LengthException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\OutOfBoundsException
     * @group specification
     */
    public function testOutOfBoundsException()
    {
        $this->expectException(Exception\OutOfBoundsException::class);
        throw new Exception\OutOfBoundsException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\OutOfRangeException
     * @group specification
     */
    public function testOutOfRangeException()
    {
        $this->expectException(Exception\OutOfRangeException::class);
        throw new Exception\OutOfRangeException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\OverflowException
     * @group specification
     */
    public function testOverflowException()
    {
        $this->expectException(Exception\OverflowException::class);
        throw new Exception\OverflowException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\RuntimeException
     * @group specification
     */
    public function testRuntimeException()
    {
        $this->expectException(Exception\RuntimeException::class);
        throw new Exception\RuntimeException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\UnderflowException
     * @group specification
     */
    public function testUnderflowException()
    {
        $this->expectException(Exception\UnderflowException::class);
        throw new Exception\UnderflowException(__METHOD__);
    }

    /**
     * @covers Pbraiders\App\Exception\UnexpectedValueException
     * @group specification
     */
    public function testUnexpectedValueException()
    {
        $this->expectException(Exception\UnexpectedValueException::class);
        throw new Exception\UnexpectedValueException(__METHOD__);
    }
}
