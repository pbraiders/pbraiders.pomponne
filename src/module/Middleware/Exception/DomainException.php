<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Middleware\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Middleware\Exception;

/**
 * Exception thrown if a value does not adhere to a defined valid data domain.
 * This represents error in the program logic and should be detected at compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class DomainException extends \DomainException implements ExceptionInterface
{

}
