<?php

namespace BehatResources;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

class ResourceExtension implements Extension
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        //
    }

    /**
     * Returns the extension config key.
     *
     * @return string
     */
    public function getConfigKey()
    {
        return 'resources';
    }

    /**
     * Initializes other extensions.
     *
     * This method is called immediately after all extensions are activated but
     * before any extension `configure()` method is called. This allows extensions
     * to hook into the configuration of other extensions providing such an
     * extension point.
     *
     * @param ExtensionManager $extensionManager
     */
    public function initialize(ExtensionManager $extensionManager)
    {
        //
    }

    /**
     * Setups configuration for the extension.
     *
     * @param ArrayNodeDefinition $builder
     */
    public function configure(ArrayNodeDefinition $builder)
    {
        $paths = $builder->children()->arrayNode('path')->children();
        foreach (array('resources', 'base') as $namespaceType) {
            $paths->scalarNode($namespaceType);
        }
        $builder->children()->variableNode('resource_map');
        $builder->children()->scalarNode('factory_class');
    }

    /**
     * Loads extension services into temporary container.
     *
     * @param ContainerBuilder $container
     * @param array $config
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/config'));
        $loader->load('services.xml');

        if (!empty($config['path'])) {
            if (isset($config['path']['resources'])) {
                $container->setParameter('paths.resources.resource', $config['path']['resources']);
            }

            if (isset($config['path']['base'])) {
                $container->setParameter('paths.resources.base', $config['path']['base']);
            }
        }

        if (!empty($config['resource_map'])) {
            $container->setParameter('resource.map', $config['resource_map']);
        }
    }
}