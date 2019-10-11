<?php

declare(strict_types=1);

return [
    //
    'scheme is missing' => [
        'input' => [
            'application' => [
                'website' => [],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'scheme is not valid' => [
        'input' => [
            'application' => [
                'website' => [
                    'scheme' => 'ftp',
                ],
            ],
            'php' => [
                'session.cookie_secure' => '0',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
