<?php

namespace Gr8abbasi\Container\Factory;

use Gr8abbasi\Container\Container;
use Gr8abbasi\Container\Exception\NotFoundException;
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

        foreach ($serviceArguments as $argument) {
            $arguments[] = $container->get($argument);
        }

        return $arguments;
    }

    /**
     * @inheritdoc
     */
    public function create($service, Container $container)
    {
        if (!class_exists($service['class'])) {
            throw new NotFoundException(
                'Class does not exists: ' . $service['class']
            );
        }

        $class = new \ReflectionClass($service['class']);
        $arguments = isset($service['arguments']) ? $service['arguments'] : [] ;

        return $class->newInstanceArgs(
            $this->resolveArguments(
                $arguments,
                $container
            )
        );
    }
}
