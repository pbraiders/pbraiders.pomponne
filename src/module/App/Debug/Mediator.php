<?php

declare(strict_types=1);

/**
 * Home.
 *
 * @package Pbraiders\App\Debug
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\App\Debug;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception;
use Pbraiders\Service\Utils\MediatorPattern\Mediator as AbstractMediator;

final class Mediator extends AbstractMediator
{
    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws \RuntimeException
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction(Request $request, Response $response, array $params = []): Response
    {
        // View must exist
        if (is_null($this->pView)) {
            throw new \RuntimeException('The view is missings.');
        }

        $sTemplate = 'not implemented yet';
        $response->getBody()->write($sTemplate);

        return $response;
    }
}
