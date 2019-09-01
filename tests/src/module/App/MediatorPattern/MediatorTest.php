<?php

declare(strict_types=1);

namespace PbraidersTest\Service\Container;

use League\Container\Container;
use PbraidersTest\App\MediatorPattern\EmptyMediator;
use PbraidersTest\App\MediatorPattern\EmptyModelColleague;
use PbraidersTest\App\MediatorPattern\EmptyRequest;
use PbraidersTest\App\MediatorPattern\EmptyResponse;
use PbraidersTest\App\MediatorPattern\EmptyViewColleague;
use PbraidersTest\Utils\ReflectionTrait;
use Slim\Exception;

class MediatorTest extends \PHPUnit\Framework\TestCase
{

    use ReflectionTrait;

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testSetView()
    {
        $pContainer = new Container();
        $pViewCollegue = new EmptyViewColleague();
        $pMediator = new EmptyMediator($pContainer);
        $pMediator->setView($pViewCollegue);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\App\MediatorPattern\EmptyMediator', 'pView');
        $pActual = $pProperty->getValue($pMediator);
        $this->assertSame($pViewCollegue, $pActual);
    }

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testSetModel()
    {
        $pContainer = new Container();
        $pModelCollegue = new EmptyModelColleague();
        $pMediator = new EmptyMediator($pContainer);
        $pMediator->setModel($pModelCollegue);
        $pProperty = $this->getPrivateProperty('\PbraidersTest\App\MediatorPattern\EmptyMediator', 'pModel');
        $pActual = $pProperty->getValue($pMediator);
        $this->assertSame($pModelCollegue, $pActual);
    }

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testGetAction()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pRequest = new EmptyRequest();
        $pResponse = new EmptyResponse();
        $this->expectException(Exception\HttpNotFoundException::class);
        $pMediator->getAction($pRequest, $pResponse);
    }

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testPostAction()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pRequest = new EmptyRequest();
        $pResponse = new EmptyResponse();
        $this->expectException(Exception\HttpNotFoundException::class);
        $pMediator->postAction($pRequest, $pResponse);
    }

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testPutAction()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pRequest = new EmptyRequest();
        $pResponse = new EmptyResponse();
        $this->expectException(Exception\HttpNotFoundException::class);
        $pMediator->putAction($pRequest, $pResponse);
    }

    /**
     * @covers \Pbraiders\App\MediatorPattern\Mediator
     * @group specification
     */
    public function testDeleteAction()
    {
        $pContainer = new Container();
        $pMediator = new EmptyMediator($pContainer);
        $pRequest = new EmptyRequest();
        $pResponse = new EmptyResponse();
        $this->expectException(Exception\HttpNotFoundException::class);
        $pMediator->deleteAction($pRequest, $pResponse);
    }
}
