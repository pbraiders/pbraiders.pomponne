<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Bootstrap;

use Pbraiders\Pomponne\Application\Bootstrap\ContainerFactoryStage;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Bootstrap\ContainerFactoryStage
 */
class ContainerFactoryStageTest extends \PHPUnit\Framework\TestCase
{

    /**
     * Undocumented function
     *
     * @return array
     */
    public function provideSucessData(): array
    {
        $aData = require(__DIR__ . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..'
            . \DIRECTORY_SEPARATOR . 'Service' . \DIRECTORY_SEPARATOR . 'Container'
            . \DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'data.success.php');
        return $aData;
    }

    /**
     * @covers ::boot
     * @uses \Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::boot
     * @uses \Pbraiders\Pomponne\Service\Container\Factory::create
     * @dataProvider provideSucessData
     * @group specification
     */
    public function testBoot(array $input, string $expected)
    {
        $pStage = new ContainerFactoryStage();
        $pActual = $pStage->boot($input);
        $this->assertTrue($pActual instanceof $expected);
    }
}
