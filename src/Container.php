<?php

namespace Gr8abbasi\Container;

use Interop\Container\ContainerInterface;
use Gr8abbasi\Container\Exception\NotFoundException;
use Gr8abbasi\Container\Exception\ContainerException;
use Gr8abbasi\Container\Factory\ConfigFileServiceFactory;
use Gr8abbasi\Container\Repository\InMemoryServiceRepository;

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
        $this->repository = $repository ?: new InMemoryServiceRepository();
        $this->factory = $factory ?: new ConfigFileServiceFactory();
    }

    /**
     * {@inheritdoc}
     */
    public function get($name)
    {
        if (!$this->has($name)) {
            throw new NotFoundException('Service not found: ' . $name);
        }

        if (is_null($this->repository->get($name))) {
            // foreach($this->services[$name] as $id => $service){

            if (isset($this->services[$name]['arguments'])) {
                foreach ($this->services[$name]['arguments'] as $argument) {
                    // $input = $this->container->get($argument);
                    /**
                     * TODO
                     * Check if dependency already resolved or not
                     */
                    $this->validate($name);
                    $service = $this->factory->create($this->services[$argument]['class']);
                    $this->repository->add($name, $service);
                }
            }

            // }
            $this->validate($name);
            $service = $this->factory->create($this->services[$name]['class']);
            $this->repository->add($name, $service);
        }

        return $this->repository->get($name);
    }

    /**
     * {@inheritdoc}
     */
    public function has($name)
    {
        return isset($this->services[$name]);
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

        if (!class_exists($this->services[$name]['class'])) {
            throw new ContainerException(
                'Class does not exists: ' . $this->services[$name]['class']
            );
        }
    }
}
