<?php

declare(strict_types=1);

return [
    [
        'input' => [
            'application' => [
                'temporary_path' => '/tmp',
                'website' => [
                    'host' => 'www.domain.tld',
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
                'session.cookie_secure' => '0',
                'session.save_path' => '',
            ],
        ],
        'expected' =>  [
            'application' => [
                'temporary_path' => '/tmp',
                'website' => [
                    'host' => 'www.domain.tld',
                    'scheme' => 'https',
                ],
            ],
            'php' => [
                'session.cookie_domain' => 'www.domain.tld',
                'session.cookie_secure' => '1',
                'session.save_path' => '/tmp',
            ],
        ],
    ],
];
