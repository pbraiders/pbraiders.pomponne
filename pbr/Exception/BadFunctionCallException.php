<?php

/**
 * @package Pbraiders\Pomponne\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Exception;

/**
 * Exception thrown if a callback refers to an undefined function or if some
 * arguments are missing.
 * This represents error in the program logic and should be detected at
 * compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class BadFunctionCallException extends \BadFunctionCallException implements ExceptionInterface
{ }
