<?php

declare(strict_types=1);

return [
    //
    'working directory is missing' => [
        'input' => [
            'application' => [],
            'service' => [
                'logger' => [
                    'error_log' => '%s/var/log/pbraiders_error.log',
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'error log path is missing' => [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'service' => [
                'logger' => [],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'error log path is not valid' => [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'service' => [
                'logger' => [
                    'error_log' => '   ',
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
