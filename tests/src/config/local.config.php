<?php

declare(strict_types=1);

/**
 * Contains configuration parameters.
 *
 * @link    https://phptherightway.com/#configuration_files for recommandations.
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository.
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

return [

    'application' => [

        // Configure PBRaiders website URL. If PBRaiders is installed into a directory called "pbraiders" for the
        //  domain www.example.com, define ['website']['url'] like this:
        'website' => [
            'url' => 'https://www.pbraiders.fr/v2.0.0/',
        ],

    ],

    'service' => [

        // Configure database settings.
        'database' => [
            // Database Name used by PBRaiders.
            'name' => 'pbraidersdb',
            // Username used to access Database.
            'username' => 'pbraidersdbuser',
            // Password used by Username to access Database.
            'password' => 'px4bEcncp8327eeW',
        ],

        'error' => [
            // If set to 1, the application will use 'whoops error handling library' instead of the default PHP one.
            // Usefull during development
            'use_whoops' => true,
        ],

    ],

    // These are various options for php
    // Do not change unless you know what you are doing
    'php' => [

        // Sets which PHP errors are reported.
        'error_reporting' => E_ALL,

        // Determines whether errors should be printed to the screen as part of the output or if they should be hidden from the user.
        'display_errors' => '1',

        // Even when display_errors is on, errors that occur during PHP's startup sequence are not displayed.
        // It's strongly recommended to keep display_startup_errors off, except for debugging.
        'display_startup_errors' => '1',

        // This parameter will show a report of memory leaks detected by the Zend memory manager.
        'report_memleaks' => '1',

    ],

];
