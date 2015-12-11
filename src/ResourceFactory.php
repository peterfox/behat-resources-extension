<?php

namespace BehatResources;

interface ResourceFactory
{
    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildObject($class, $type, $arguments = []);

    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildPersistedObject($class, $type, $arguments = []);
}