<?php

namespace Gr8abbasi\Container;

use Mcustiel\Config\Drivers\Reader\php\Reader;
use Mcustiel\Config\ConfigLoader;

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
        $loader = new ConfigLoader($filePath, new Reader());
        $config = $loader->load();
        // var_dump($config);exit;

        $this->services = ['hello'];
        return $this->services;
    }

}
