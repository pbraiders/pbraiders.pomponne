<?php

/**
 * This file is a part of the Pomponne version of Pbraiders
 *
 * @package Pbraiders\Application\Exception
 */

namespace Pbraiders\Application\Exception;

/**
 * Exception thrown when performing an invalid operation on an empty container, such as removing an element.
 * This represents errors that cannot be detected at compile time.
 */
class UnderflowException extends \UnderflowException implements ExceptionInterface
{ }
