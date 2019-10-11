<?php

declare(strict_types=1);

/**
 * Data for cache path tests.
 */

return [
    //
    'working directory is missing' => [
        'input' => [
            'application' => [
                'cache_path' => '%s/var/cache',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'cache path is missing' => [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'cache path is not valid' => [
        'input' => [
            'application' => [
                'working_directory' => '/var/www/pbraiders',
                'cache_path' => '    ',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
