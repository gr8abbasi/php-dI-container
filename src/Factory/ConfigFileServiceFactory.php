<?php

namespace Gr8abbasi\Container\Factory;

use Gr8abbasi\Container\Factory\ServiceFactoryInterface;

/**
 * ConfigFileServiceFactory
 */
class ConfigFileServiceFactory implements ServiceFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function create($service)
    {
        $class = new \ReflectionClass($service);
        return $class->newInstance();
    }
}
