<?php

declare(strict_types=1);

/**
 * Data for cache path tests.
 */

return [
    //
    'cache_path setting is missing' => [
        'input' => [
            'application' => [],
            'service' => [
                'container' => [
                    'enable_compilation' => true,
                    'write_proxies_to_file' => true
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'enable_compilation setting is missing' => [
        'input' => [
            'application' => [
                'cache_path' => '%s/var/cache',
            ],
            'service' => [
                'container' => [
                    'write_proxies_to_file' => true
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'write_proxies_to_file setting is not valid' => [
        'input' => [
            'application' => [
                'cache_path' => '%s/var/cache',
            ],
            'service' => [
                'container' => [
                    'enable_compilation' => true,
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
];
