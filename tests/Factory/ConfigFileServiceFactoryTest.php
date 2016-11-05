<?php

namespace Tests\Factory;

use Tests\DummyServices;
use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\Container;
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

        $classA = new DummyServices\ClassA;
        $classB = new DummyServices\ClassB($classA);
        $object = new DummyServices\ClassC($classA, $classB);

        $this->assertEquals($service, $object);
        $this->assertInstanceOf(
            'Tests\DummyServices\ClassC',
            $service
        );
    }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\NotFoundException
     * @expectedExceptionMessage Class does not exists: Foo\FooService\ClassFoo
     */
    public function throwClassNotFoundException()
    {
        $container = new Container([
            'foo' => [
                'class'     => 'Foo\\FooService\\ClassFoo',
                'arguments' => [
                    'potato',
                    'tomato',
                ],
            ],
        ]);
        $container->get('foo');
    }
}
