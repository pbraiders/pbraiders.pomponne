<?php

declare(strict_types=1);

/**
 * Home.
 *
 * @package Pbraiders\App\Home
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Home;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception;
use Pbraiders\App\MediatorPattern\Mediator as AbstractMediator;

final class Mediator extends AbstractMediator
{
    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction(Request $request, Response $response, array $params = []): Response
    {
        $sTemplate = $this->pView->sayHello();
        $response->getBody()->write($sTemplate);

        //$a = 1 / 0;
        //trigger_error("notice triggered", E_USER_NOTICE);
        //trigger_error("error triggered", E_USER_ERROR);

        return $response;
    }

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postAction(Request $request, Response $response, array $params = []): Response
    {
        throw new Exception\HttpNotFoundException($request);
    }
}
