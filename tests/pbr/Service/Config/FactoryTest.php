<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Service\Config;

use Pbraiders\Pomponne\Service\Config\Exception\DirectoryNotExistNorWritableException;
use Pbraiders\Pomponne\Service\Config\Factory;

class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Factory
     * @group specification
     */
    public function testCreate()
    {
        $sDir = getcwd();
        if (FALSE === $sDir) {
            exit(33);
        }
        $sDir .= \DIRECTORY_SEPARATOR . 'tests';
        $pFactory = new Factory();
        $aActual = $pFactory->create($sDir);
        $this->assertTrue(is_array($aActual));
        $this->assertFalse(empty($aActual));
    }

    /**
     * @covers \Pbraiders\Pomponne\Service\Config\Factory
     * @group specification
     */
    public function testCreateException()
    {
        $pFactory = new Factory();
        $this->expectException(DirectoryNotExistNorWritableException::class);
        $pFactory->create('doesnotexists');
    }
}
