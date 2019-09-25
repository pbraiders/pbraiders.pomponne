<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\ErrorHandler;

use Pbraiders\Pomponne\Service\ErrorHandler\Factory;
use Whoops\Run;

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Pomponne\Service\ErrorHandler\Factory
     * @group specification
     */
    public function testCreate()
    {
        $pFactory = new Factory();
        $pErrorHandler = $pFactory->create();
        $this->assertTrue($pErrorHandler instanceof Run);
    }
}
