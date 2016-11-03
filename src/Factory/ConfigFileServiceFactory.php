<?php

namespace Gr8abbasi\Container\Factory;

use Gr8abbasi\Container\Container;
use Gr8abbasi\Container\Factory\ServiceFactoryInterface;

/**
 * ConfigFileServiceFactory
 */
class ConfigFileServiceFactory implements ServiceFactoryInterface
{
    /**
     * Resolve the service arguments
     *
     * @param array $serviceArguments
     * @param Container $container
     *
     * @return mixed $service
     */
    private function resolveArguments($serviceArguments, Container $container)
    {
        $arguments = [];

        if (!empty($serviceArguments)) {
            foreach ($serviceArguments as $argument) {
                $arguments[] = $container->get($argument);
            }
        }
        return $arguments;
    }

    /**
     * @inheritdoc
     */
    public function create($service, Container $container)
    {
        $class = new \ReflectionClass($service['class']);

        return $class->newInstanceArgs(
            $this->resolveArguments($service['arguments'],
            $container
        ));
    }
}
