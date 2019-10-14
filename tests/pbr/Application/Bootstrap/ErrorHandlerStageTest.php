<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\ErrorHandlerStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\ErrorHandlerStage
 */
class ErrorHandlerStageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::boot
     * @uses Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::boot
     * @uses \Pbraiders\Pomponne\Service\ErrorHandler\Factory::create
     * @group specification
     */
    public function testBoot()
    {
        $pStage = new ErrorHandlerStage();

        $pStage->boot(['service' => ['error' => ['use_whoops' => true]]]);

        $this->assertTrue(restore_error_handler());
        $this->assertTrue(restore_exception_handler());
    }
}
