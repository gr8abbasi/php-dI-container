<?php

namespace Gr8abbasi\Container;

use Interop\Container\ContainerInterface;
use Gr8abbasi\Container\Exception\NotFoundException;

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
     * Constructor for Container
     *
     * @param array $services
     */
    public function __construct($services)
    {
        $this->services = $services;
        $this->serviceStore = [];
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException('Service not found: '.$id);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->services[$id]);
    }
}
