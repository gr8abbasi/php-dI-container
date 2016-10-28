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
        // $service = $this->factory->create([
        //     'foo' => 'Tests\DummyServices\ClassA'
        // ]);
        // // var_dump($service);exit;
        //
        // $this->assertInstanceOf(
        //     'Tests\DummyServices\ClassA',
        //     $service
        // );
    }

    // /**
    //  * @test
    //  * @expectedException Gr8abbasi\Container\Exception\NotFoundException
    //  * @expectedExceptionMessage Service not found: foo
    //  */
    // public function throwsNotFoundException()
    // {
    //     $this->factory->create('foo');
    // }

    /**
     * @test
     * @expectedException Gr8abbasi\Container\Exception\ContainerException
     * @expectedExceptionMessage Class does not exists: FooClass\Foo
     */
    // public function throwContainerExceptionOnServiceNotFound()
    // {
    //     $object = new Std();
    //     $object->id = "foo";
    //     $object->class = "FooClass\Foo";
    //
    //     $this->factory->create('foo');
    // }
}
