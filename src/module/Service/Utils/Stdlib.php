<?php

declare(strict_types=1);

/**
 * Stdlib is a class that implements general purpose utility function for different scopes.
 *
 * @package Pbraiders\Service\Utils
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Service\Utils;

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
        return array_walk($options, function ($newvalue, string $option) {
            @ini_set($option, (string) $newvalue);
        });
    }
}
