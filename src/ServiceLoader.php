<?php

namespace Gr8abbasi\Container;

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
     *
     * @param string $configFilePath
     * @param ConfigReader $configReader
     * @param CacheConfig $cacheConfig
     *
     * @return array $services
     */
    public function loadServices(
        $configFilePath,
        $configReader,
        $cacheConfig = null
    )
    {
        $loader = new ConfigLoader(
            $configFilePath,
            $configReader,
            $cacheConfig
        );
        $config = $loader->load();
        // var_dump($config->getFullConfigAsArray());exit;

        $this->services = ['hello'];
        return $this->services;
    }

}
