<?php

declare(strict_types=1);

/**
 *
 * @package Pbraiders\Application
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Application;

class Application
{

    /**
     * Sets the values of PHP configuration options.
     *
     * The array should be an associative array like:
     *  'php_option_name' => 'new_value_for_the_option'
     *
     * @see https://www.php.net/manual/en/function.array-walk.php
     * @param array $config
     * @return boolean
     */
    public function configurePHP(array $config): bool
    {
        return array_walk($config, function( $newvalue, string $varname )
        {
            @ini_set($varname, (string) $newvalue);
        });
    }

}
