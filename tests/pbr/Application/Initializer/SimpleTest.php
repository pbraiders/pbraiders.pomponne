<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Initializer;

use Pbraiders\Pomponne\Application\Application;
use Pbraiders\Pomponne\Application\Exception\InvalidWorkingDirectoryException;
use Pbraiders\Pomponne\Application\Initializer\Simple;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Initializer\Simple
 */
class SimpleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::initialize
     * @uses \Pbraiders\Pomponne\Application\Initializer\Initializer
     * @group specification
     */
    public function testInitializeException()
    {
        $this->expectException(InvalidWorkingDirectoryException::class);
        $pInitializer = new Simple();
        $pInitializer
            ->setWorkingDir('     ')
            ->initialize();
    }

    /**
     * @covers ::initialize
     * @uses \Pbraiders\Pomponne\Application\Initializer\Initializer
     * @uses \Pbraiders\Pomponne\Service\Config\Factory
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Session
     * @uses \Pbraiders\Pomponne\Service\Config\Processor\Website
     * @uses \Pbraiders\Pomponne\Service\Container\Factory
     * @uses \Pbraiders\Pomponne\Application\Application
     * @group specification
     */
    public function testInit()
    {
        $pInitializer = new Simple();
        $pApplication = $pInitializer->initialize();
        $this->assertTrue($pApplication instanceof Application);
    }
}
