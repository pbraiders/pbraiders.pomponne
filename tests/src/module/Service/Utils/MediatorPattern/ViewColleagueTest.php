<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Utils\MediatorPattern;

use League\Plates\Engine;
use PbraidersTest\Service\Utils\MediatorPattern\EmptyViewColleague;
use PbraidersTest\Utils\ReflectionTrait;

class ViewColleagueTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\Utils\MediatorPattern\ViewColleague
     * @group specification
     */
    public function testSetEngine()
    {
        $pEngine = new Engine();
        $pCollegue = new EmptyViewColleague();
        $pCollegue->setEngine($pEngine);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\Service\Utils\MediatorPattern\EmptyViewColleague', 'pEngine');
        $pActual = $pProperty->getValue($pCollegue);
        $this->assertSame($pEngine, $pActual);
    }
}
