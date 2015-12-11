<?php

namespace BehatResources\ResourceClassResolver;

use BehatResources\ResourceClassResolver;

class SimpleResourceClassResolver implements ResourceClassResolver
{

    /**
     * @var array
     */
    private $map;

    /**
     * SimpleResourceClassResolver constructor.
     * @param array $map
     */
    public function __construct(array $map)
    {
        $this->map = $map;
    }

    /**
     * @param string $type
     * @return string|null
     */
    public function getClassForType($type)
    {
        if (isset($this->map[$type])) {
            return $this->map[$type];
        }

        return null;
    }
}