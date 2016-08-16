<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Gr8abbasi\Container\Container;
use DummyServices\DummyService;

/**
 * Container Test
 */
class ContainerTest extends TestCase
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
        $this->container = new Container('dummy-service');
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
        $input = $this->container->get("dummy-service");

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
     * @expectedExceptionMessage something went wrong with container
     */
    public function throwContainerException()
    {
        $this->container->get('foo');
    }
}
