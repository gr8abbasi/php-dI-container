<?php

namespace Tests\Factory;

use PHPUnit_Framework_TestCase;

/**
 * JsonServiceFactory Test
 */
class JsonServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Container
     */
    public $container;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->container = new Container([
            'dummy-service' => DummyService::class,
        ]);
    }

    /**
     * @test
     */
    public function isInstanceOfContainerInterface()
    {
        $this->assertInstanceOf(Container::class, $this->container);
    }

    /**
     * @test
     */
    public function canGetServiceFromContainer()
    {
        $input = $this->container->get('dummy-service');

        $this->assertInstanceOf(DummyService::class, $input);
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
            'foo' => ''
        ]);
        $container->get('foo');
    }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\ContainerException
     * @expectedExceptionMessage Class does not exists: FooClass\Foo
     */
    public function throwContainerExceptionOnServiceNotFound()
    {
        $container = new Container([
            'foo' => 'FooClass\Foo'
        ]);
        $container->get('foo');
    }
}
