<?php

namespace Gr8abbasi\Container;

use Interop\Container\ContainerInterface;
use Gr8abbasi\Container\Exception\NotFoundException;
use Gr8abbasi\Container\Exception\ContainerException;
use Gr8abbasi\Container\Repository\InMemoryServiceRepository;
use Gr8abbasi\Container\Factory\ConfigFileServiceFactory;

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
     * @var array
     */
    private $serviceStore;

    /**
     * @var ServiceRepositoryInterface
     */
    private $repository;

    /**
     * @var ServiceFactoryInterface
     */
    private $factory;

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
        $this->serviceStore = [];
        $this->repository = $repository ?: new InMemoryServiceRepository();
        // $this->factory = $factory ?: new ConfigFileServiceFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new NotFoundException('Service not found: ' . $name);
        }

        if (!isset($this->serviceStore[$name])) {
            $this->serviceStore[$name] = $this->createService($name);
        }

        return $this->serviceStore[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->services[$name]);
    }

    /**
     * Create service instance
     *
     * @param string $name
     *
     * @return mixed created service
     */
    private function createService($name)
    {
        if (!isset($this->services[$name]) || empty($this->services[$name])) {
            throw new ContainerException(
                'Service should be an array with key value pair: ' . $name
            );
        }

        if (!class_exists($this->services[$name]['class'])) {
            throw new ContainerException(
                'Class does not exists: ' . $this->services[$name]['class']
            );
        }

        $service = new \ReflectionClass($this->services[$name]['class']);
        return $service->newInstance();
    }
}
