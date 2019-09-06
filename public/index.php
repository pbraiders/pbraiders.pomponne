<?php

declare(strict_types=1);

/**
 * Public entry point.
 *
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

/** @var ROOT_PATH document root path */
define('ROOT_PATH', realpath(dirname(__DIR__)));

/** @var PBR_PATH PBR path */
define('PBR_PATH', \ROOT_PATH . \DIRECTORY_SEPARATOR . 'pbr');

require \PBR_PATH . \DIRECTORY_SEPARATOR . 'pbr' . \DIRECTORY_SEPARATOR . 'bootstrap.php';
