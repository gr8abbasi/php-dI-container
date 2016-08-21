<?php

namespace Tests\Repository;

use PHPUnit_Framework_TestCase;
use Gr8abbasi\Container\Repository\InMemoryServiceRepository;

/**
 * InMemoryServiceRepository Test
 */
class InMemoryServiceRepositoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Repository
     */
    public $repository;

    /**
     * Setup tests
     */
    public function setUp()
    {
        $this->repository = new InMemoryServiceRepository;
    }

    /**
     * @test
     */
    public function isInstanceOfRepositoryInterface()
    {
        $this->assertInstanceOf(
            'Gr8abbasi\Container\Repository\ServiceRepositoryInterface',
            $this->repository
        );
    }

    /**
     * @test
     */
    public function canRetrieveServiceFromRepository()
    {
        $id = 'dummy-service';
        $service = 'Tests\DummyService\DummyService';

        $this->repository->add($id, $service);
        $output = $this->repository->get($id);

        $this->assertEquals($service, $output);
    }

    /**
     * @test
     */
    public function returnNullIfServiceNotInRepository()
    {
        $output = $this->repository->get('dummy-service');

        $this->assertNull($output);
    }
}
