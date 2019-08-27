<?php

declare(strict_types=1);

// @var string Root path.
define('PBR_PATH', realpath(__DIR__));

// Includes the Composer autoloader
require realpath(\PBR_PATH . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . '..' . \DIRECTORY_SEPARATOR . 'src' . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');
