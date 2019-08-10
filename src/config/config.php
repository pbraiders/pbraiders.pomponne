<?php

/**
 * Contains configuration parameters
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

return [

    // Configure PBRaiders website URL. If PBRaiders is installed into a directory called "pbraiders" for the
    //  domain example.com, define 'website_url' like this:
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
 Set Cookie Domain # Set Cookie Domain

The domain set in the cookies for WordPress can be specified for those with unusual domain setups. For example, if subdomains are used to serve static content, you can set the cookie domain to only your non-static domain to prevent WordPress cookies from being sent with each request to static content on your subdomain .

define( 'COOKIE_DOMAIN', 'www.example.com' );

The WP_DEBUG option controls the reporting of some errors and warnings and enables use of the WP_DEBUG_DISPLAY and WP_DEBUG_LOG settings. The default boolean value is false.

define( 'WP_DEBUG', true );

Database errors are printed only if WP_DEBUG is set to true. Database errors are handled by the wpdb class and are not affected by PHP’s error settings.

Setting WP_DEBUG to true also raises the error reporting level to E_ALL and activates warnings when deprecated functions or files are used; otherwise, WordPress sets the error reporting level to E_ALL ^ E_NOTICE ^ E_USER_NOTICE.

Configure Error Logging # Configure Error Logging

Configuring error logging can be a bit tricky. First of all, default PHP error log and display settings are set in the php.ini file, which you may or may not have access to. If you do, they should be set to the desired settings for live PHP pages served to the public. It’s strongly recommended that no error messages are displayed to the public and instead routed to an error log. Further more, error logs should not be located in the publicly accessible portion of your server. Sample recommended php.ini error settings:

error_reporting = 4339
display_errors = Off
display_startup_errors = Off
log_errors = On
error_log = /home/example.com/logs/php_error.log
log_errors_max_len = 1024
ignore_repeated_errors = On
ignore_repeated_source = Off
html_errors = Off
@ini_set( 'log_errors', 'Off' );
@ini_set( 'display_errors', 'On' );
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', true );

define( 'WP_DEBUG', true ); // Or false
if ( WP_DEBUG ) {
    define( 'WP_DEBUG_LOG', true );
    define( 'WP_DEBUG_DISPLAY', false );
    @ini_set( 'display_errors', 0 );
}

Increasing memory allocated to PHP # Increasing memory allocated to PHP

WP_MEMORY_LIMIT option allows you to specify the maximum amount of memory that can be consumed by PHP. This setting may be necessary in the event you receive a message such as “Allowed memory size of xxxxxx bytes exhausted”.

This setting increases PHP Memory only for WordPress, not other applications. By default, WordPress will attempt to increase memory allocated to PHP to 40MB (code is at the beginning of /wp-includes/default-constants.php) for single site and 64MB for multisite, so the setting in wp-config.php should reflect something higher than 40MB or 64MB depending on your setup.

WordPress will automatically check if PHP has been allocated less memory than the entered value before utilizing this function. For example, if PHP has been allocated 64MB, there is no need to set this value to 64M as WordPress will automatically use all 64MB if need be.

Note: Some hosts do not allow for increasing the PHP memory limit automatically. In that event, contact your host to increase the PHP memory limit. Also, many hosts set the PHP limit at 8MB.

Increase PHP Memory to 64MB

define( 'WP_MEMORY_LIMIT', '64M' );

https://wordpress.org/support/article/editing-wp-config-php/
*/
