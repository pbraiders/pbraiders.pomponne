<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Application\Exception
 */

namespace Pbraiders\Application\Exception;

/**
 * Exception thrown if a callback refers to an undefined method or if some arguments are missing.
 * This represents error in the program logic and should be detected at compile time.
 * This kind of exceptions should directly lead to a fix in the code.
 */
class BadMethodCallException extends \BadMethodCallException implements ExceptionInterface
{ }
