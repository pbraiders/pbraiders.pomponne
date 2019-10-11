<?php

declare(strict_types=1);

return [
    //
    'temporary path is missing' => [
        'input' => [
            'application' => [],
            'php' => [
                'session.save_path' => '',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'temporary path is not valid' => [
        'input' => [
            'application' => [
                'temporary_path' => '       ',
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
    //
    'temporary path is not a dir' => [
        'input' => [
            'application' => [
                'temporary_path' => __FILE__,
            ],
            'php' => [
                'session.save_path' => '',
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidAccessPermissionException::class
    ],
];
