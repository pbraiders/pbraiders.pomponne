<?php

declare(strict_types=1);

/**
 * Interface for mediator.
 *
 * @package Pbraiders\App\Mediator
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Utils\MediatorPattern;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Undocumented interface
 */
interface HttpActionInterface
{
    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction(Request $request, Response $response, array $params = []): Response;

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function postAction(Request $request, Response $response, array $params = []): Response;

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function putAction(Request $request, Response $response, array $params = []): Response;

    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function deleteAction(Request $request, Response $response, array $params = []): Response;
}
