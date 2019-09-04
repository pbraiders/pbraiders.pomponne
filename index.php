<?php

/**
 * Avoid access to this directory.
 * In case .htaccess does not work.
 */

header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
