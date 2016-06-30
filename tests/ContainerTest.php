<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Gr8abbasi\Container\Container;

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
        $this->container = new Container();
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
     * @expectedException Interop\Container\ContainerException
     * @expectedExceptionMessage something went wrong with container
     */
    public function throwContainerException()
    {
        $this->container->get('foo');
    }
}
