<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Service\Utils
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Utils\Stdlib;

/**
 * Sets the values of PHP configuration options.
 *
 * The array should be an associative array like:
 *  'php_option_name' => 'new_value_for_the_option'
 *
 * @see https://www.php.net/manual/en/function.array-walk.php
 * @param array $options
 * @return boolean
 */
function configurePHP(array $options): bool
{
    return array_walk($options, function (string $newvalue, string $option): void {
        @ini_set($option, (string) $newvalue);
    });
}

/**
 * Sort an array by key, recursively.
 *
 * @see https://www.php.net/manual/en/function.ksort.php
 * @param mixed $array
 * @return void
 */
function sortArrayByKey(&$array): void
{
    if (is_array($array)) {
        ksort($array, SORT_STRING);
        array_walk($array, '\Pbraiders\Service\Utils\Stdlib\sortArrayByKey');
    }
}

/**
 * Test if a string is empty.
 *
 * @param string $value
 * @return boolean
 */
function isEmptyString(string $value): bool
{
    $bReturn = false;
    $sValue = trim($value);
    if (strlen($sValue) == 0) {
        $bReturn = true;
    }
    return $bReturn;
}

/**
 * Returns an array containing all the entries of array1 which have keys that are present in $array2, recursively.
 *
 * @param array $array1 The array with master keys to check.
 * @param array $array2 The array to compare keys against.
 * @return array Returns an associative array containing all the entries of array1 which have keys that are present in
 * $array2.
 */
function intersectArrayByKey(array $array1, array $array2): array
{
    $array1 = array_intersect_key($array1, $array2);
    foreach ($array1 as $key => $value) {
        if (is_array($value) && is_array($array2[$key])) {
            $array1[$key] = intersectArrayByKey($value, $array2[$key]);
        }
    }
    return $array1;
}

/**
 * Checks if the given key or index exists in the array. At a specific depth.
 *
 * $array1 is a multi-dimensionnal array with many keys and values.
 *
 * $array2 is the filter and should be with one key by depth level:
 * $array2 = [
 *    'level1' => [
 *      'level2'=> [
 *         ... => [
 *           'the_key' => 'the_value',
 *           ],
 *         ],
 *       ],
 *    ],
 *
 * @param array $array1 The array with the key to check.
 * @param array $array2 The array to compare key against. Must contains only one key, at any depth.
 * @return boolean Returns true if the key exists at the same depth.
 */
function existsDepthKeyInArray(array $array1, array $array2): bool
{
    $bReturn = false;

    // Use the intersect method.
    $aActual = intersectArrayByKey($array1, $array2);

    //If the key exists at the same depth both arrays have the same key count.
    if (\count($aActual, \COUNT_RECURSIVE) === \count($array2, \COUNT_RECURSIVE)) {
        $bReturn = true;
    }

    return $bReturn;
}

/**
 * Checks if the given key or index exists in the array. At a specific depth.
 *
 * $array1 is a multi-dimensionnal array with many keys and values.
 *
 * $array2 is the filter and should be with one key by depth level:
 * $array2 = [
 *    'level1' => [
 *      'level2'=> [
 *         ... => [
 *           'the_key' => 'the_value',
 *           ],
 *         ],
 *       ],
 *    ],
 *
 * @param array $array1 The array with the key to check.
 * @param array $array2 The array to compare key against. Must contains only one key, at any depth.
 * @return mixed Returns the value
 */
function extractDepthKeyInArray(array $array1, array $array2)
{
    $return = null;

    // The filter has only one key by level.
    foreach ($array2 as $key => $value) {
        // The key must exists
        if (array_key_exists($key, $array1)) {
            if (is_array($value)) {
                if (is_array($array1[$key])) {
                    // Deep searching
                    $return = extractDepthKeyInArray($array1[$key], $value);
                } else {
                    // Error, the value should be an array.
                    $return = null;
                    break;
                }
            } else {
                // Not an array that means we return the value.
                $return = $array1[$key];
                break;
            }
        } else {
            // Error, the key is missing.
            $return = null;
            break;
        }
    }

    return $return;
}
