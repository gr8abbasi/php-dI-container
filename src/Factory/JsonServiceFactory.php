<?php

namespace Gr8abbasi\Container\Factory;

use Gr8abbasi\Container\Exception\NotFoundException;
use Gr8abbasi\Container\Exception\ContainerException;

/**
 * Class JsonServiceFactory
 */
class JsonServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var array $services
     */
    private $services;

    /**
     * Constructor
     *
     * @param string $jsonFile
     *
     */
    public function __construct($jsonFile)
    {
       $this->loadServiceList($jsonFile);
    }

    /**
     * @param string $jsonFile
     *
     * @return array
     */
    private function loadJsonFile($jsonFile)
    {
        $jsonString = file_get_contents($jsonFile);
        return json_decode($jsonString);
    }

    /**
     * @param string $jsonFile
     *
     * @return void
     */
    private function loadServiceList($jsonFile)
    {
       $services =  $this->loadJsonFile($jsonFile);

       foreach($services->services as $service) {
           $this->services[$service->id] = $service;
       }
    }

    /**
     * @inheritdoc
     */
    public function create($service)
    {
        if(!isset($this->services[$service])) {
            throw new NotFoundException('Service not found: ' . $service);
        }

        if (!class_exists($this->services[$service]->class)) {
            throw new ContainerException(
                'Class does not exists: ' . $this->services[$service]->class
            );
        }

        $service = new \ReflectionClass($this->services[$service]->class);
        return $service->newInstance();
    }
}
