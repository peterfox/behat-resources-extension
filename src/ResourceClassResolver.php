<?php

namespace BehatResources;

interface ResourceClassResolver
{
    /**
     * @param string $type
     * @return string
     */
    public function getClassForType($type);
}