<?php

declare(strict_types=1);

/**
 * Data for website tests.
 */

return [
    //
    'url is missing' => [
        'input' => [
            'application' => [
                'website' => [
                    'url_is_missing' => 'https://www.pbraiders.fr/v2/',
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException::class
    ],
    //
    'url is not valid' => [
        'input' => [
            'application' => [
                'website' => [
                    'url' => '   ',
                ],
            ],
        ],
        'expected' => \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException::class
    ],
];
