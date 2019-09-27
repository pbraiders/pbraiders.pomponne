<?php

declare(strict_types=1);

/**
 * @package Pbraiders\Pomponne\Service\Config\Processor
 * @link    https://github.com/pbraiders/pomponne for the canonical source repository
 * @license https://github.com/pbraiders/pomponne/blob/master/LICENSE GNU General Public License v3.0 License.
 */

namespace Pbraiders\Pomponne\Service\Config\Processor;

use League\Uri\Parser;
use Pbraiders\Config\Processor\Processor;
use Pbraiders\Pomponne\Service\Config\Exception;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Modifies Website section of the settings.
 */
final class Website extends Processor
{

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely an array
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException If settings is missing.
     * @throws \Pbraiders\Pomponne\Service\Config\Exception\InvalidSettingException If settings is not valid.
     * @throws \InvalidArgumentException If URl is not valid.
     * @return mixed Returns the modified config.
     */
    public function process($settings)
    {
        /**
         * Filters the settings
         */

        /** @var array $aFilter Website url filter */
        $aFilter = ['application' => ['website' => ['url' => true]]];
        $aSettings = \array_intersect_key($settings, $aFilter);

        /** @var mixed|null $sUrl The url*/
        $sUrl = extractDepthKeyInArray($aSettings, $aFilter);
        if (!is_string($sUrl)) {
            throw new Exception\MissingSettingException('The application.website.url setting is missing.');
        }
        $sUrl = trim($sUrl);
        if (strlen($sUrl) == 0) {
            throw new Exception\InvalidSettingException('The application.website.url setting is not valid.');
        }

        /**
         * Parse the url according to RFC3986
         */

        /** @var array $aWebsite Website settings */
        $aWebsite = &$settings['application']['website'];
        $pParser = new Parser();

        // Modifies the settings.
        $aWebsite = array_merge($aWebsite, $pParser($sUrl));

        // Next
        return parent::process($settings);
    }
}
