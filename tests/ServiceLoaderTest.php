<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\ServiceLoader;

/**
 * ServiceLoader Test
 */
class ServiceLoaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceLoader
     */
    public $serviceLoader;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->serviceLoader = new ServiceLoader();
    }

    /**
     * @test
     */
    public function isInstanceOfServiceLoader()
    {
        $this->assertInstanceOf(ServiceLoader::class, $this->serviceLoader);
    }

    /**
     * @test
     */
    public function canLoadServicesFromConfigFile()
    {
        $services = $this->serviceLoader->loadServices(__DIR__ . "/DummyServices/phpServicesConfig.php");

        $this->assertNotNull($services);
        $this->assertNotEmpty($services);
    }
}
