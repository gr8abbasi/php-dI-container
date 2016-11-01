<?php

namespace Tests\Factory;

use PHPUnit_Framework_TestCase;
use Tests\DummyServices\DummyService;
use Gr8abbasi\Container\Factory\ConfigFileServiceFactory;

/**
 * ConfigFileServiceFactoryTest
 */
class ConfigFileServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ConfigFileServiceFactory
     */
    public $factory;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->factory = new ConfigFileServiceFactory();
    }

    /**
     * @test
     */
    public function isInstanceOfFactoryInterface()
    {
        $this->assertInstanceOf(
            'Gr8abbasi\Container\Factory\ServiceFactoryInterface',
            $this->factory
        );
    }

    /**
     * @test
     */
    public function canCreateInstanceOfRequestedService()
    {
        $service = $this->factory->create('Tests\DummyServices\ClassA');

        $this->assertInstanceOf(
            'Tests\DummyServices\ClassA',
            $service
        );
    }
}
