<?php

namespace Gr8abbasi\Container\Repository;

/**
 * Describes Service Repository Interface
 */
interface ServiceRepositoryInterface
{
    /**
     * @param string $id
     *
     * @return mixed Service
     */
    public function get($id);

    /**
     * @param string $id
     * @param string $service
     *
     */
    public function add($id, $service);
}
