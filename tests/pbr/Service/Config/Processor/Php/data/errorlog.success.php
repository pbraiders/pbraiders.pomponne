<?php

declare(strict_types=1);

return [
    [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'php' => [
                'error_log' => '%s/var/log/%s_php_error.log',
            ],
        ],
        'expected' =>  [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'php' => [
                'error_log' => sprintf('/var/www/pbraiders/var/log/%s_php_error.log', date("Ymd")),
            ],
        ],
    ],
];
