<?php

namespace Gr8abbasi\Container\Factory;

use Gr8abbasi\Container\Container;

/**
 * Describes interface for Service Factory
 */
interface ServiceFactoryInterface
{
    /**
     * Creates desired service instance
     *
     * @param array $service
     * @param Container $container
     *
     * @return mixed created service
     */
    public function create($service, Container $container);
}
