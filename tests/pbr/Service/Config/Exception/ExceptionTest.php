<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config\Exception;

use Pbraiders\Pomponne\Service\Config\Exception;

class ExceptionTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers Pbraiders\Pomponne\Service\Config\Exception\InvalidWorkingDirException
     * @group specification
     */
    public function testBadFunctionCallException()
    {
        $this->expectException(Exception\InvalidWorkingDirException::class);
        throw new Exception\InvalidWorkingDirException(__METHOD__);
    }
}
