<?php

declare(strict_types=1);

return [
    [
        'input' => [
            'application' => [
                'temporary_path' => '/tmp',
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ],
        'expected' =>  [
            'application' => [
                'temporary_path' => '/tmp',
            ],
            'php' => [
                'session.save_path' => '/tmp',
            ],
        ],
    ],
];
