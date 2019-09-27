<?php

/**
 * @package Pbraiders\Pomponne\Service\Config\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Exception;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 */
class InvalidAccessPermissionException extends \RuntimeException implements ExceptionInterface
{
}
