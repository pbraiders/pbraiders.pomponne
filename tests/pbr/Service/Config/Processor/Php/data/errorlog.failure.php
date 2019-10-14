<?php

declare(strict_types=1);

return [
    //
    'working directory is missing' => [
        'input' => [
            'application' => [],
            'php' => [
                'error_log' => '%s/var/log/%s_php_error.log',
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
            'php' => [],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'error log path is not valid' => [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
            'php' => [
                'error_log' => '   ',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
