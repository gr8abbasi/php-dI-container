<?php

namespace Tests;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\Container;

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
        foreach ($this->services as $id => $service) {
            if (isset($service['arguments'])) {
                foreach ($service['arguments'] as $argument) {
                    $input = $this->container->get($argument);
                    $this->assertInstanceOf($this->services[$argument]['class'], $input);
                }
            }

            $input = $this->container->get($id);
            $this->assertInstanceOf($service['class'], $input);
        }
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
     * @expectedException Gr8abbasi\Container\Exception\ContainerException
     * @expectedExceptionMessage Class does not exists: Foo\FooService\ClassFoo
     */
    public function throwContainerExceptionOnServiceNotFound()
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
