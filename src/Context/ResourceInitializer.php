<?php

namespace BehatResources\Context;

use Behat\Behat\Context\Context;
use Behat\Behat\Context\Initializer\ContextInitializer;
use ReflectionClass;
use BehatResources\ResourceBuilder;
use BehatResources\ResourceLoader;
use BehatResources\ResourceLoader\FileResourceLoader;

class ResourceInitializer implements ContextInitializer
{

    /**
     * @var ResourceBuilder
     */
    private $builder;

    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Initializes provided context.
     *
     * @param Context $context
     */
    public function initializeContext(Context $context)
    {
        if ($context instanceof ResourceContext) {
            $reflector = new ReflectionClass(get_class($context));

            if ($this->builder->getLoader() instanceof FileResourceLoader) {
                if ($this->builder->getLoader()->getBasePath() == null) {
                    $this->builder->getLoader()->setBasePath(dirname($reflector->getFileName()));
                }
            }

            if ($context->getResourceFactory()) {
                $this->builder->setFactory($context->getResourceFactory());
            }

            $context->setResourceBuilder($this->builder);
        }
    }
}