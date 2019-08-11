<?php

// Application constants
define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'dev'));
define('APPLICATION_NAME', 'Pbraiders-Pomponne');
define('APPLICATION_VERSION', 'v2.0.0');
define('APPLICATION_PATH', dirname(__DIR__));
define('APPLICATION_PATH_DATA', \APPLICATION_PATH . \DIRECTORY_SEPARATOR . 'data');
define('APPLICATION_PATH_CONFIG', \APPLICATION_PATH . \DIRECTORY_SEPARATOR . 'tests' . \DIRECTORY_SEPARATOR . 'config');

// Composer autoloading
include __DIR__ . '/../src/vendor/autoload.php';
