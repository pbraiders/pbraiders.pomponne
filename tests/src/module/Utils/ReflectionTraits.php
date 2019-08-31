<?php

declare(strict_types=1);

/**
 * Utility traits for reflection.
 *
 * @package PbraidersTest\Utils
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace PbraidersTest\Utils;

use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

trait ReflectionTrait
{

    /**
     * get private and protected method.
     *
     * @param string $className
     * @param string $methodName
     * @return \ReflectionMethod
     */
    public function getPrivateMethod(string $className, string $methodName): ReflectionMethod
    {
        $pReflector = new ReflectionClass($className);
        $pMethod = $pReflector->getMethod($methodName);
        $pMethod->setAccessible(true);
        return $pMethod;
    }

    /**
     * get private and protected property.
     *
     * @param string $className
     * @param string $propertyName
     * @return \ReflectionProperty
     */
    public function getPrivateProperty(string $className, string $propertyName): ReflectionProperty
    {
        $pReflector = new ReflectionClass($className);
        $pProperty = $pReflector->getProperty($propertyName);
        $pProperty->setAccessible(true);
        return $pProperty;
    }
}
