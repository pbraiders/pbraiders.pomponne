<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Container\Exception
 */

namespace Pbraiders\Container\Exception;

/**
 * Exception thrown if a value does not adhere to a defined valid data domain.
 * This represents error in the program logic and should be detected at compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class DomainException extends \DomainException implements ExceptionInterface
{

}
