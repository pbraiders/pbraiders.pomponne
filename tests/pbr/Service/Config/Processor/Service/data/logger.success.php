<?php

declare(strict_types=1);

return [
    [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'service' => [
                'logger' => [
                    'error_log' => '%s/var/log/pbraiders_error.log',
                ],
            ],
        ],
        'expected' =>  [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'service' => [
                'logger' => [
                    'error_log' => '/var/www/pbraiders/var/log/pbraiders_error.log',
                ],
            ],
        ],
    ],
];
