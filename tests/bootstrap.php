<?php

declare(strict_types=1);

// @var string Root path.
defined('PBR_PATH') || define('PBR_PATH', realpath(dirname(__DIR__)));

// Includes the Composer autoloader
require realpath(\PBR_PATH . \DIRECTORY_SEPARATOR . 'vendor' . \DIRECTORY_SEPARATOR . 'autoload.php');
