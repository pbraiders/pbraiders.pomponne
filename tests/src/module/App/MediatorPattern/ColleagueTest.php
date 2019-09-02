<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Container;

use League\Container\Container;
use PbraidersTest\App\MediatorPattern\EmptyColleague;
use PbraidersTest\App\MediatorPattern\EmptyMediator;
use PbraidersTest\Utils\ReflectionTrait;

class ColleagueTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\App\MediatorPattern\Colleague
     * @group specification
     */
    public function testSetMediator()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pCollegue = new EmptyColleague();
        $pCollegue->setMediator($pMediator);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\App\MediatorPattern\EmptyColleague', 'pMediator');
        $pActual = $pProperty->getValue($pCollegue);
        $this->assertSame($pMediator, $pActual);
    }
}
