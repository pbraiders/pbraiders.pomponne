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
use Pbraiders\Pomponne\Service\Config\Exception\MissingSettingException;
use Pbraiders\Pomponne\Service\Config\Exception\SettingNotValidException;

use function Pbraiders\Stdlib\extractDepthKeyInArray;

/**
 * Modifies Website section of the settings.
 */
class Website extends Processor
{

    /** @var array Website url filter */
    protected $aFilter = [
        'application' => [
            'website' => [
                'url' => true
            ],
        ],
    ];

    /**
     * Process the setting structure and call the next processor.
     *
     * @param mixed $settings. Usely an array
     * @throws MissingSettingException If settings is missing.
     * @throws SettingNotValidException If settings is not valid.
     * @throws \InvalidArgumentException If URl is not valid.
     * @return mixed Returns the modified config.
     */
    public function process($settings)
    {

        // Retrieves the website value
        /** @var mixed|null */
        $sValue = extractDepthKeyInArray($settings, $this->aFilter);
        if (! is_string($sValue)) {
            throw new MissingSettingException('The application.website.url setting is missing in the config file.');
        }
        $sValue = trim($sValue);
        if (strlen($sValue) == 0) {
            throw new SettingNotValidException('The application.website.url setting is not valid.');
        }

        // Parse the url according to RFC3986

        /** @var array */
        $aWebsite = &$settings['application']['website'];

        /** @var \League\Uri\Parser */
        $pParser = new Parser();

        // Modifies the settings.
        $aWebsite = array_merge($aWebsite, $pParser($sValue));

        // Next
        return parent::process($settings);
    }
}
