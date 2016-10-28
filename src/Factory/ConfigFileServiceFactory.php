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
    public function create(array $service)
    {
        // var_dump($service['foo']);exit;
        // $name = 'foo';
        // if (!isset($service[$name]) || empty($service[$name])) {
        //     throw new ContainerException(
        //         'Service should be an array with key value pair: ' . $name
        //     );
        // }
        //
        // if (!class_exists($service[$name]['class'])) {
        //     throw new ContainerException(
        //         'Class does not exists: ' . $service[$name]['class']
        //     );
        // }
        //
        // $class = new \ReflectionClass($service[$name]['class']);
        // return $class->newInstance();
    }
}
