<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Utils\MediatorPattern;

use League\Container\Container;
use PbraidersTest\Service\Utils\MediatorPattern\EmptyColleague;
use PbraidersTest\Service\Utils\MediatorPattern\EmptyMediator;
use PbraidersTest\Utils\ReflectionTrait;

class ColleagueTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\Service\Utils\MediatorPattern\Colleague
     * @group specification
     */
    public function testSetMediator()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pCollegue = new EmptyColleague();
        $pCollegue->setMediator($pMediator);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\Service\Utils\MediatorPattern\EmptyColleague', 'pMediator');
        $pActual = $pProperty->getValue($pCollegue);
        $this->assertSame($pMediator, $pActual);
    }
}
