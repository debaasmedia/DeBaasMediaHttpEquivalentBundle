<?php

namespace DeBaasMedia\Bundle\HttpEquivalentBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator
  , Symfony\Component\Config\Definition\Processor
  , Symfony\Component\Config\Definition\Builder\TreeBuilder
  , Symfony\Component\DependencyInjection\Loader\XmlFileLoader
  , Symfony\Component\DependencyInjection\ContainerBuilder
  , Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * DeBaasMediaHttpEquivalentExtension
 *
 * @author  Marijn Huizendveld <marijn.huizendveld@gmail.com>
 */
final class DeBaasMediaHttpEquivalentExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load (array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
    
        $config = $processor->process($this->generateConfigTree(new TreeBuilder), $configs);
    
        $loader = new XmlFileLoader($container, new FileLocator(array(__DIR__ . '/../Resources/config')));
    
        $loader->load('http-equivalent.xml');
    }
  
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function generateConfigTree (TreeBuilder $arg_builder)
    {
        $arg_builder->root('debaasmedia_http_equivalent')
                      ->children()
                      ->end()
                    ->end();
    
        return $arg_builder->buildTree();
    }

}