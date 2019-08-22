<?php

declare(strict_types=1);

/**
 * Public entry point.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

// @var string Root path.
define('PBR_PATH', realpath((dirname(__DIR__))));

require \PBR_PATH . \DIRECTORY_SEPARATOR . 'bootstrap.php';
