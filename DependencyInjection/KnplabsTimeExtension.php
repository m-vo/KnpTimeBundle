<?php

namespace Knplabs\TimeBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;

class KnplabsTimeExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        foreach (self::normalizeKeys($configs) as $config) {
            $this->doConfigLoad($config, $container);
        }
    }

    public function doConfigLoad(array $config, ContainerBuilder $container)
    {
        if(!$container->hasDefinition('time.templating.helper.time')) {
            $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
            $loader->load('templating.xml');
            $loader->load('twig.xml');
        }
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     */
    public function getXsdValidationBasePath()
    {
        return null;
    }

    public function getNamespace()
    {
        return 'http://www.symfony-project.org/schema/dic/symfony';
    }

    public function getAlias()
    {
        return 'knplabs_time';
    }
}