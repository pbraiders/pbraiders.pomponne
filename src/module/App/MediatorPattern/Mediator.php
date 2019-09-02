<?php

declare(strict_types=1);

/**
 * Abstract class for mediator.
 *
 * @package Pbraiders\App\Mediator
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\MediatorPattern;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception;
use Pbraiders\App\MediatorPattern\ColleagueInterface;
use Pbraiders\App\MediatorPattern\HttpActionInterface;

/**
 * Undocumented class
 */
abstract class Mediator implements HttpActionInterface
{
    /**
     * Undocumented variable
     *
     * @var ContainerInterface|null
     */
    protected $pContainer = null;

    /**
     * Undocumented variable
     *
     * @var ColleagueInterface|null
     */
    protected $pModel = null;

    /**
     * Undocumented variable
     *
     * @var ColleagueInterface|null
     */
    protected $pView = null;

    /**
     * Undocumented function
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->pContainer = $container;
    }

    /**
     * Undocumented function
     *
     * @param ColleagueInterface $view
     * @return void
     */
    public function setView(ColleagueInterface $view): void
    {
        $this->pView = $view;
        $this->pView->setMediator($this);
    }

    /**
     * Undocumented function
     *
     * @param ColleagueInterface $view
     * @return void
     */
    public function setModel(ColleagueInterface $model): void
    {
        $this->pModel = $model;
        $this->pModel->setMediator($this);
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws Exception\HttpNotFoundException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction(Request $request, Response $response, array $params = []): Response
    {
        throw new Exception\HttpNotFoundException($request);
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws Exception\HttpNotFoundException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postAction(Request $request, Response $response, array $params = []): Response
    {
        throw new Exception\HttpNotFoundException($request);
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws Exception\HttpNotFoundException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putAction(Request $request, Response $response, array $params = []): Response
    {
        throw new Exception\HttpNotFoundException($request);
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws Exception\HttpNotFoundException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteAction(Request $request, Response $response, array $params = []): Response
    {
        throw new Exception\HttpNotFoundException($request);
    }
}
