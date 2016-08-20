<?php

namespace Gr8abbasi\Container\Repository;

/**
 * Describes Service Repository Interface
 */
interface ServiceRepositoryInterface
{
    /**
     * @param string $service
     *
     * @throws NotFoundException
     *
     * @return mixed Service
     */
    public function get($service);

    /**
     * @param string $service
     *
     * @throws ContainerException
     */
    public function add($service);
}
