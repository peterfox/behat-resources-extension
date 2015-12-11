<?php

namespace BehatResources\Context;

use BehatResources\ResourceBuilder;
use BehatResources\ResourceFactory;
use BehatResources\ResourceLoader;

interface ResourceContext
{
    /**
     * @param ResourceBuilder $builder
     */
    public function setResourceBuilder(ResourceBuilder $builder);

    /**
     * @param $type
     * @param $identifier
     * @return array
     */
    public function getResource($type, $identifier);

    /**
     * @param $type
     * @param $identifier
     * @return object
     */
    public function getResourceObject($type, $identifier);

    /**
     * @param $type
     * @param $identifier
     * @return object
     */
    public function getPersistedResourceObject($type, $identifier);

    /**
     * Returns your implementation of the ResourceFactory for changing resources into Objects/Models/Entities etc.
     *
     * @return ResourceFactory|null
     */
    public function getResourceFactory();
}