Behat Resources
=============

A simple little extension for Behat which will let you turn yaml files into Models/Entities/Objects to make your
given steps better.

Installation
------------

Install via composer:

```
composer require peterfox/behat-resources-extension
```

Then Add the extension to your behat.yml config:

```yml
# behat.yml

default:
  ...
  extensions:
    BehatResources\ResourceExtension:
        path:
          resource: Resources # default value
          base: # Not required but useful, it will otherwise be the folder for the context loaded
        resource_map: # This is a map of Directories and the class it is an alias for
          User: Namespace\Of\Entity

```
Make an implementation for a ResourceFactory like the example below for Laravel/Eloquent:

```php
<?php

use BehatResources\ResourceFactory;

class EloquentResourceFactory implements ResourceFactory
{
    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildObject($class, $type, $arguments = [])
    {
        return factory($class)->make($arguments);
    }

    /**
     * @param string $class
     * @param string $type
     * @param array $arguments
     * @return Object
     */
    public function buildPersistedObject($class, $type, $arguments = [])
    {
        return factory($class)->create($arguments);
    }
}

```

Make your context implement ResourceContext:

```php
<?php

use BehatResources\Context\ResourceContext;

class FeatureContext extends MinkContext implements ResourceContext
{
    private $builder;

    /**
     * @param ResourceBuilder $builder
     */
    public function setResourceBuilder(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param $type
     * @param $identifier
     * @return array
     */
    public function getResource($type, $identifier)
    {
        return $this->resourceBuilder->getLoader()->load($type, $identifier);
    }

    /**
     * @param $type
     * @param $identifier
     * @return object
     */
    public function getResourceObject($type, $identifier)
    {
        return $this->resourceBuilder->build($type, $identifier);
    }
    
    /**
     * @param $type
     * @param $identifier
     * @return object
     */
    public function getPersistedResourceObject($type, $identifier)
    {
        return $this->resourceBuilder->build($type, $identifier);
    }

    /**
     * Returns your implementation of the ResourceFactory for changing resources into Objects/Models/Entities etc.
     *
     * @return ResourceFactory|null
     */
    public function getResourceFactory()
    {
        return new EloquentResourceFactory();
    }
}
```

Then you can create a Resources directory and create types as folders e.g. User. Within those types you can add
yaml based configs like the following:

```
#features/bootstrap/Resources/User/Peter.yml
name: Peter
email: peter.fox@peterfox.me
password: howdyho1!

```

In your context you can create a behat step like so:

```php
    /**
     * @Given /^there is a ([^"]*) called "([^"]*)"$/
     */
    public function thereIsACalled($resource, $name)
    {
        $this->getPersistedResourceObject($resource, $name);
    }  
```

So you can use the following step in your features like so:

```
 Given there is a User called "Peter"
```