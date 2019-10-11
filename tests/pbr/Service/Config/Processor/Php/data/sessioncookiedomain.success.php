<?php

declare(strict_types=1);

return [
    [
        'input' => [
            'application' => [
                'website' => [
                    'host' => 'www.domain.tld',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ],
        'expected' =>  [
            'application' => [
                'website' => [
                    'host' => 'www.domain.tld',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
            'php' => [
                'session.cookie_domain' => 'www.domain.tld',
            ],
        ],
    ],
];
