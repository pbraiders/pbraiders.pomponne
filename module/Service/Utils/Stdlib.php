<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Service\Utils
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Utils;

/**
 * Stdlib is a class that implements general purpose utility function for different scopes.
 */
class Stdlib
{

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
    public function configurePHP(array $options): bool
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
     */
    public static function sortArrayByKey(&$array)
    {
        if (is_array($array)) {
            ksort($array, SORT_STRING);
            array_walk($array, '\Pbraiders\Service\Utils\Stdlib::sortArrayByKey');
        }
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