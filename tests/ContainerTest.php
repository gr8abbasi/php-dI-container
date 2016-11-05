<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\Container;
use Tests\DummyServices\phpServicesConfig;

/**
 * Container Test
 */
class ContainerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    public $container;

    /**
     * @var array
     */
    public $serviceLoader;

    /**
     * @var array
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
        $this->container = new Container($this->services);
    }

    /**
     * @test
     */
    public function isInstanceOfContainerInterface()
    {
        $this->assertInstanceOf('Interop\Container\ContainerInterface', $this->container);
    }

    /**
     * @test
     */
    public function canGetServiceFromContainer()
    {
        $input = $this->container->get('class-c');
        $this->assertInstanceOf($this->services['class-c']['class'], $input);
    }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\NotFoundException
     * @expectedExceptionMessage Service not found: foo
     */
    public function throwsNotFoundException()
    {
        $this->container->get('foo');
    }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\ContainerException
     * @expectedExceptionMessage Service should be an array with key value pair: foo
     */
    public function throwContainerException()
    {
        $container = new Container([
            'foo' => '',
        ]);
        $container->get('foo');
    }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\CircularDependencyException
     * @expectedExceptionMessage Circular dependency detected: => class-c
     */
    public function throwCircularDependencyException()
    {
        $services = [
            'class-b' => [
                'class'     => 'Tests\\DummyServices\\ClassB',
                'arguments' => [
                    'class-c',
                ],
            ],
            'class-c' => [
                'class'     => 'Tests\\DummyServices\\ClassC',
                'arguments' => [
                    'class-b',
                ],
            ],
        ];

        $container = new Container($services);
        $container->get('class-c');
    }
}
