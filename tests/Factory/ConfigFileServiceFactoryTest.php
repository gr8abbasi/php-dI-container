<?php

namespace Tests\Factory;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\Container;
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
     * @var Container
     */
    public $container;

    /**
     * @var array $services
     */
    public $services;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->services = [
            'class-a' => [
                'class' => 'Tests\\DummyServices\\ClassA',
            ],
            'class-b' => [
                'class'     => 'Tests\\DummyServices\\ClassB',
                'arguments' => [
                    'class-a',
                ],
            ],
            'class-c' => [
                'class'     => 'Tests\\DummyServices\\ClassC',
                'arguments' => [
                    'class-a',
                    'class-b',
                ],
            ],
        ];

        $this->factory = new ConfigFileServiceFactory();
        $this->container = new Container($this->services);

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
        $service = $this->factory->create(
            $this->services['class-c'],
            $this->container
        );

        $this->assertInstanceOf(
            'Tests\DummyServices\ClassC',
            $service
        );
    }
}
