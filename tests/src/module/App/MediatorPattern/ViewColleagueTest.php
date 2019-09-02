<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Container;

use League\Plates\Engine;
use PbraidersTest\App\MediatorPattern\EmptyViewColleague;
use PbraidersTest\Utils\ReflectionTrait;

class ViewColleagueTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\App\MediatorPattern\ViewColleague
     * @group specification
     */
    public function testSetEngine()
    {
        $pEngine = new Engine();
        $pCollegue = new EmptyViewColleague();
        $pCollegue->setEngine($pEngine);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\App\MediatorPattern\EmptyViewColleague', 'pEngine');
        $pActual = $pProperty->getValue($pCollegue);
        $this->assertSame($pEngine, $pActual);
    }
}
