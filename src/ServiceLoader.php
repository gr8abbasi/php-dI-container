<?php

namespace Gr8abbasi\Container;

/**
 * Class ServiceLoader
 *
 * Loads configuration from different file types
 */
class ServiceLoader
{
    /**
     * @var array $services
     */
    private $services;

    /**
     * Load Services from config files
     * using php file config library
     */
    public function loadServices($filePath)
    {
        /**
         * REMOVE ME AND ADD LIBRARY CODE HERE
         */
        $this->services = ['hello'];
        return $this->services;
    }

}
