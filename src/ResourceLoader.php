<?php

namespace BehatResources;

interface ResourceLoader
{
    /**
     * @param string $type
     * @param string $identifier
     * @return array
     */
    public function load($type, $identifier);
}