<?php

declare(strict_types=1);

return [
    //
    'host is missing' => [
        'input' => [
            'application' => [
                'website' => [],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'host is not valid' => [
        'input' => [
            'application' => [
                'website' => [
                    'host' => '   ',
                ],
            ],
            'php' => [
                'session.cookie_domain' => '',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
