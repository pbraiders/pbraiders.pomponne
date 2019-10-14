<?php

declare(strict_types=1);

/**
 * Data for cache path tests.
 */

return [
    [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
                'cache_path' => '%s/var/cache',
            ],
        ],
        'expected' =>  [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
                'cache_path' => '/var/www/pbraiders/var/cache',
            ],
        ],
    ],
];
