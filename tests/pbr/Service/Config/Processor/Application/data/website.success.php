<?php

declare(strict_types=1);

/**
 * Data for website tests.
 */

return [
    [
        'input' => [
            'application' => [
                'website' => [
                    'url' => 'https://www.pbraiders.fr/v2/',
                ],
            ],
        ],
        'expected' =>  [
            'application' => [
                'website' => [
                    'url' => 'https://www.pbraiders.fr/v2/',
                    'scheme' => 'https',
                    'user' => null,
                    'pass' => null,
                    'host' => 'www.pbraiders.fr',
                    'port' => null,
                    'path' => '/v2/',
                    'query' => null,
                    'fragment' => null,
                ],
            ],
        ],
    ],
];
