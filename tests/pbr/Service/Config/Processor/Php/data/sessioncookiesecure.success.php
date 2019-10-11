<?php

declare(strict_types=1);

return [
    'https scheme' => [
        'input' => [
            'application' => [
                'website' => [
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ],
        'expected' =>  [
            'application' => [
                'website' => [
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '1',
            ],
        ],
    ],
    'http scheme' => [
        'input' => [
            'application' => [
                'website' => [
                    'scheme' => 'http',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '1',
            ],
        ],
        'expected' =>  [
            'application' => [
                'website' => [
                    'scheme' => 'http',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ],
    ],
];
