<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\ServiceLoader;
use Mcustiel\Config\Drivers\Reader\php\Reader as PhpReader;
use Mcustiel\Config\Drivers\Reader\ini\Reader as IniReader;
use Mcustiel\Config\Drivers\Reader\json\Reader as JsonReader;
use Mcustiel\Config\Drivers\Reader\yaml\Reader as YamlReader;

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
    public function canLoadServicesFromPhpConfigFile()
    {
        $services = $this->serviceLoader->loadServices(
            __DIR__ . "/Fixtures/phpServicesConfig.php",
            new PhpReader()
        );

        $this->assertContainsOnly('array', $services);
        $this->assertNotEmpty($services);
    }

    /**
     * @test
     */
    public function canLoadServicesFromJsonConfigFile()
    {
        $services = $this->serviceLoader->loadServices(
            __DIR__ . "/Fixtures/jsonServicesConfig.json",
            new JsonReader()
        );

        $this->assertContainsOnly('array', $services);
        $this->assertNotEmpty($services);
    }

    /**
     * @test
     */
    public function canLoadServicesFromYamlConfigFile()
    {
        $services = $this->serviceLoader->loadServices(
            __DIR__ . "/Fixtures/yamlServicesConfig.yml",
            new YamlReader()
        );

        $this->assertContainsOnly('array', $services);
        $this->assertNotEmpty($services);
    }

    /**
     * @test
     */
    public function canLoadServicesFromIniConfigFile()
    {
        $services = $this->serviceLoader->loadServices(
            __DIR__ . "/Fixtures/iniServicesConfig.ini",
            new IniReader()
        );

        $this->assertContainsOnly('array', $services);
        $this->assertNotEmpty($services);
    }
}
