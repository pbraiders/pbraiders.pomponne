<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\DoNothing;

class DoNothingTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Pomponne\Application\Bootstrap\DoNothing
     * @group specification
     */
    public function testBootstrap()
    {
        $pBootstrap = new DoNothing();
        $pBootstrap->bootstrap();
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
