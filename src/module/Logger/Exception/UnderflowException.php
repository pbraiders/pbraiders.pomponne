<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Logger\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Logger\Exception;

/**
 * Exception thrown when performing an invalid operation on an empty container, such as removing an element.
 * This represents errors that cannot be detected at compile time.
 */
class UnderflowException extends \UnderflowException implements ExceptionInterface
{ }
