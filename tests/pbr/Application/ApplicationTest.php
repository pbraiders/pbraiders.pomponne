<?php

declare(strict_types=1);

namespace PbraidersTest\Pomponne\Application\Application;

use Pbraiders\Pomponne\Application\Application;
use Slim\App;

/**
 * @coversDefaultClass \Pbraiders\Pomponne\Application\Application
 */
class ApplicationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::init
     * @uses Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::boot
     * @uses Pbraiders\Pomponne\Application\Bootstrap\AbstractStage::setNext
     * @uses Pbraiders\Pomponne\Application\Bootstrap\ConfigurationStage::boot
     * @uses Pbraiders\Pomponne\Application\Bootstrap\ContainerFactoryStage::boot
     * @uses Pbraiders\Pomponne\Application\Bootstrap\ErrorHandlerStage::boot
     * @uses Pbraiders\Pomponne\Application\Bootstrap\PHPStage::boot
     * @uses Pbraiders\Pomponne\Application\Init\AbstractStage::initialize
     * @uses Pbraiders\Pomponne\Application\Init\AbstractStage::setNext
     * @uses Pbraiders\Pomponne\Application\Init\RegisterLoggerStage::initialize
     * @uses Pbraiders\Pomponne\Application\Init\SlimBridgeStage::initialize
     * @uses Pbraiders\Pomponne\Service\Config\Factory::create
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\CachePath::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\TemporaryPath::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\Website::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Application\WorkingDir::setWorkingDir
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\ErrorLog::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\Session::process
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processCookieDomain
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processCookieSecure
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Php\Session::processSessionSavePath
     * @uses Pbraiders\Pomponne\Service\Config\Processor\Service\Logger::process
     * @uses Pbraiders\Pomponne\Service\Container\Factory::create
     * @uses Pbraiders\Pomponne\Service\ErrorHandler\Factory::create
     * @group specification
     */
    public function test_init_Success()
    {
        $aConfig = [
            'application' => [
                'working_directory' => sprintf('%s/tests/', getcwd()),
            ],
        ];
        $pReturn = Application::init($aConfig);
        $this->assertTrue($pReturn instanceof App);
    }
}
