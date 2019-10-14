<?php

declare(strict_types=1);

/**
 * Data for temporary path tests.
 */

return [
    [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
                'temporary_path' => '%s/var/cache',
            ],
        ],
        'expected' =>  [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
                'temporary_path' => '/var/www/pbraiders/var/cache',
            ],
        ],
    ],
];
