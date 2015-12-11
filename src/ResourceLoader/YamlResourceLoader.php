<?php

namespace BehatResources\ResourceLoader;

use Symfony\Component\Yaml\Yaml;

class YamlResourceLoader extends FileResourceLoader
{
    /**
     * @param string $type
     * @param string $identifier
     * @return array
     */
    public function load($type, $identifier)
    {
        $path = $this->basePath . DIRECTORY_SEPARATOR .
            $this->resourcePath . DIRECTORY_SEPARATOR .
            $type . DIRECTORY_SEPARATOR .
            $identifier.'.yml';

        if (file_exists($path)) {
            $resource = Yaml::parse(file_get_contents($path));

            return $resource;
        }

        return [];
    }
}