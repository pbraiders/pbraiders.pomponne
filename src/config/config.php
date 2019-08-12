<?php

/**
 * Contains configuration parameters.
 *
 * @link    https://phptherightway.com/#configuration_files for recommandations.
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository.
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

return [

    // Configure PBRaiders website URL. If PBRaiders is installed into a directory called "pbraiders" for the
    //  domain www.example.com, define 'website_url' like this:
    'website_url' => 'https://www.example.com/pbraiders/',

    // Configure database settings.
    'database' => [
        // Database Name used by PBRaiders.
        'name' => 'the_database_name',
        // Username used to access Database.
        'username' => 'the_user_name',
        // Password used by Username to access Database.
        'password' => 'the_password',
        // The hostname of your Database Server. A port number, Unix socket file path or pipe may be needed as well.
        'host' => 'localhost',
    ],

    // These are various options for the modules used in this application.
    'modules' => [

        'contact' => [
            // Number of items to display per page.
            'paging' => 50,
        ],

        'rent' => [
            // Number of items to display per page.
            'paging' => 50,
        ],

        'log' => [
            // Number of items to display per page.
            'paging' => 50,
            // Set to true if you want to write log in a file.
            'file_enable' => false,
        ],

        'print' => [
            // Number of items to print before break page.
            'paging' => 6,
        ],

    ],

    // These are various options for php.
    // Do not change unless you know what you are doing!
    'php' => [

        // Default timezone used by all date/time functions
        'date.timezone' => 'Europe/Paris',

        // Sets which PHP errors are reported.
        'error_reporting' => E_ALL & ~E_DEPRECATED & ~E_STRICT,

        // Maximum amount of memory in bytes that a script is allowed to allocate.
        'memory_limit' => '40M',

        // Determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
        'display_errors' => '0',

        // Even when display_errors is on, errors that occur during PHP's startup sequence are not displayed.
        // It's strongly recommended to keep display_startup_errors off, except for debugging.
        'display_startup_errors' => false,

        // Name of the file where script errors should be logged.
        'error_log' => null,
        /*
session.cache_expire "180"
session.cache_limiter "nocache"
session.cookie_domain ""
session.cookie_httponly ""
session.cookie_lifetime "0"
session.cookie_path "/"
session.cookie_secure ""
....
*/

    ],

    'other' => [

        'cookie' => [
            'lifetime' => 36000,
        ],

        'session' => [
            'lifetime' => 36000,
        ],

        'debug' => [
            // Set to true if you want to display error and warning on screen.
            'enable' => false,
        ],
    ],

];

/**************************
 * Réglages MySQL
 ***************************/
// Drivers - ne pas modifier
//define('PBR_DB_DSN', 'mysql:host=' . PBR_DB_HOST . ';dbname=');
 /*

https://wordpress.org/support/article/editing-wp-config-php/
*/
