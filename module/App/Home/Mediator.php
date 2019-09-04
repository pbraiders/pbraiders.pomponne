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

use Pbraiders\App\Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Pbraiders\Service\Utils\MediatorPattern\Mediator as AbstractMediator;

final class Mediator extends AbstractMediator
{
    /**
     * Undocumented function
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param array $params
     * @throws \Pbraiders\App\Exception\RuntimeException If view is not instancied.
     * @throws \RuntimeException on failure.
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function getAction(Request $request, Response $response, array $params = []): Response
    {
        // View must exist
        if (is_null($this->pView)) {
            throw new Exception\RuntimeException('The view is missings.');
        }

        $sTemplate = $this->pView->render();
        $response->getBody()->write($sTemplate);

        return $response;
    }
}
