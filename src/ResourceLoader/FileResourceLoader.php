<?php

namespace BehatResources\ResourceLoader;

use BehatResources\ResourceLoader;

abstract class FileResourceLoader implements ResourceLoader
{
    /**
     * @var string
     */
    protected $resourcePath;
    /**
     * @var string
     */
    protected $basePath;

    /**
     * FileResourceLoader constructor.
     * @param string $basePath
     * @param string $resourcePath
     */
    public function __construct($basePath, $resourcePath)
    {
        $this->basePath = $basePath;
        $this->resourcePath = $resourcePath;
    }

    /**
     * @param string $type
     * @param string $identifier
     * @return array
     */
    public abstract function load($type, $identifier);

    /**
     * @return string
     */
    public function getResourcePath()
    {
        return $this->resourcePath;
    }

    /**
     * @param string $resourcePath
     */
    public function setResourcePath($resourcePath)
    {
        $this->resourcePath = $resourcePath;
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * @param string $basePath
     */
    public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }
}