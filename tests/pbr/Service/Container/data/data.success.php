<?php

declare(strict_types=1);

use Pbraiders\Container\PhpDiFactory;

return [
    [
        'input' => [
            'application' => [
                'cache_path' => '%s/var/cache',
            ],
            'service' => [
                'container' => [
                    'enable_compilation' => false,
                    'write_proxies_to_file' => false,
                ],
            ],
        ],
        'expected' => PhpDiFactory::class,
    ],
];
