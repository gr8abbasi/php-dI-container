<?php

namespace Gr8abbasi\Container\Repository;

class InMemoryServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var array $serviceStore
     */
    private $serviceStore;

    /**
     * @inheritdoc
     */
    public function get($serviceId)
    {
        if(!isset($this->serviceStore[$serviceId]) || !isset($serviceId)){
            return Null;
        }

        return $this->serviceStore[$serviceId];
    }

    /**
     * @inheritdoc
     */
    public function add($id, $service)
    {
        $this->serviceStore[$id] = $service;
    }
}
