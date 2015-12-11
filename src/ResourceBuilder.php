<?php

namespace BehatResources;

class ResourceBuilder
{
    /**
     * @var ResourceLoader
     */
    private $loader;
    /**
     * @var ResourceClassResolver
     */
    private $resolver;

    /**
     * @var ResourceFactory
     */
    private $factory;

    public function __construct(ResourceLoader $loader, ResourceClassResolver $resolver)
    {
        $this->loader = $loader;
        $this->resolver = $resolver;
    }

    /**
     * @return ResourceLoader
     */
    public function getLoader()
    {
        return $this->loader;
    }

    /**
     * @param ResourceFactory $factory
     */
    public function setFactory($factory)
    {
        $this->factory = $factory;
    }

    /**
     * @param string $type
     * @param string $identifier
     * @return Object
     */
    public function build($type, $identifier)
    {
        $class = $this->resolver->getClassForType($type);
        $args = $this->loader->load($type, $identifier);
        return $this->factory->buildObject($class, $type, $args);
    }

    /**
     * @param string $type
     * @param string $identifier
     * @return Object
     */
    public function persist($type, $identifier)
    {
        $class = $this->resolver->getClassForType($type);
        $args = $this->loader->load($type, $identifier);
        return $this->factory->buildPersistedObject($class, $type, $args);
    }
}