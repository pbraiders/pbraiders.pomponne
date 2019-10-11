<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\PHPStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\PHPStage
 */
class PHPStageTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::boot
     * @group specification
     */
    public function testBootException()
    {
        $pStage = new PHPStage();
        $this->expectException(InvalidWorkingDirectoryException::class);
        $pStage->boot(['no_php_section' => false]);
    }

    /**
     * @covers ::boot
     * @group specification
     */
    public function testBoot()
    {
        $pStage = new PHPStage();

        $pStage->boot(['service' => ['error' => ['use_whoops' => true]]]);

        $this->assertTrue(restore_error_handler());
        $this->assertTrue(restore_exception_handler());
    }
}
