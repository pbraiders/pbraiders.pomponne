<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Service\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Exception;

/**
 * Exception thrown if an error which can only be found on runtime occurs.
 */
class RuntimeException extends \RuntimeException implements ExceptionInterface
{
}
