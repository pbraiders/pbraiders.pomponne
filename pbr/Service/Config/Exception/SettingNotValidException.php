<?php

/**
 * @package Pbraiders\Pomponne\Service\Config\Exception
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Exception;

/**
 * Exception thrown if a value does not match with a set of values.
 * Typically this happens when a function calls another function and expects the return value to be of a certain type or
 * value not including arithmetic or buffer related errors.
 * This represents errors that cannot be detected at compile time.
 */
class SettingNotValidException extends \UnexpectedValueException implements ExceptionInterface
{
}
