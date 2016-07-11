<?php

namespace Gr8abbasi\Container;

use Interop\Container\ContainerInterface;

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
     * {@inheritdoc}
     */
    public function get($id)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
    }
}
