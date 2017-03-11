<?php

namespace Gr8abbasi\Container;

use Interop\Container\ContainerInterface;
use Gr8abbasi\Container\Exception\NotFoundException;
use Gr8abbasi\Container\Exception\ContainerException;
use Gr8abbasi\Container\Factory\ConfigFileServiceFactory;
use Gr8abbasi\Container\Repository\InMemoryServiceRepository;
use Gr8abbasi\Container\Exception\CircularDependencyException;

/**
 * Container Class
 */
class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private $services;

    /**
     * @var ServiceRepositoryInterface|null
     */
    private $repository;

    /**
     * @var ServiceFactoryInterface|null
     */
    private $factory;

    /**
     * @var array
     */
    private $resolvedServices;

    /**
     * Constructor for Container
     *
     * @param array $services
     */
    public function __construct(
        array $services = [],
        ServiceRepositoryInterface $repository = null,
        ServiceFactoryInterface $factory = null
    ) {
        $this->services = $services;
        $this->repository = $repository ?: new InMemoryServiceRepository();
        $this->factory = $factory ?: new ConfigFileServiceFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Service not found: ' . $id);
        }

        if (is_null($this->repository->get($id))) {
            $this->createService($id, $this);
        }

        return $this->repository->get($id);
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->services[$name]);
    }

    /**
     * Create service and add to the
     * repository
     *
     * @param string $id
     * @param Container $container
     *
     * @return void
     */
    private function createService($id, $container)
    {
        $this->validate($id);
        $this->resolvedServices[$id] = true;
        $service = $this->factory->create($this->services[$id], $container);
        unset($this->resolvedServices[$id]);
        $this->repository->add($id, $service);
    }

    /**
     * Validate requested service before
     * attempt to resolve
     *
     * @param string $name
     *
     * @return void
     */
    private function validate($name)
    {
        if (!isset($this->services[$name]) || empty($this->services[$name])) {
            throw new ContainerException(
                'Service should be an array with key value pair: ' . $name
            );
        }

        if (isset($this->resolvedServices[$name])) {
            throw new CircularDependencyException(
                'Circular dependency detected: => ' . $name
            );
        }
    }
}
