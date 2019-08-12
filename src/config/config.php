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

    // These are various options for php
    // Do not change unless you know what you are doing
    'php' => [

        // Default timezone used by all date/time functions
        'date_default_timezone' => 'Europe/Paris',

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

Increasing memory allocated to PHP # Increasing memory allocated to PHP

WP_MEMORY_LIMIT option allows you to specify the maximum amount of memory that can be consumed by PHP. This setting may be necessary in the event you receive a message such as “Allowed memory size of xxxxxx bytes exhausted”.

This setting increases PHP Memory only for WordPress, not other applications. By default, WordPress will attempt to increase memory allocated to PHP to 40MB (code is at the beginning of /wp-includes/default-constants.php) for single site and 64MB for multisite, so the setting in wp-config.php should reflect something higher than 40MB or 64MB depending on your setup.

WordPress will automatically check if PHP has been allocated less memory than the entered value before utilizing this function. For example, if PHP has been allocated 64MB, there is no need to set this value to 64M as WordPress will automatically use all 64MB if need be.

Note: Some hosts do not allow for increasing the PHP memory limit automatically. In that event, contact your host to increase the PHP memory limit. Also, many hosts set the PHP limit at 8MB.

Increase PHP Memory to 64MB

define( 'WP_MEMORY_LIMIT', '64M' );

https://wordpress.org/support/article/editing-wp-config-php/
*/
