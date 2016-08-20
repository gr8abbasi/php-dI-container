<?php

namespace Gr8abbasi\Container\Factory;

/**
 * Describes interface for Service Factory
 */
interface ServiceFactoryInterface
{
    /**
     * Creates desired service instance
     *
     * @param array $service
     *
     * @return mixed created service
     */
    public function create($service);
}
