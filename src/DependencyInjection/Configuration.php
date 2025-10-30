<?php 

namespace Mount\CompanyInfoResolverBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder() : TreeBuilder
    {
        $treeBuilder = new TreeBuilder('mount_company_info_resolver');

        $treeBuilder->getRootNode()
        ->children()
            ->arrayNode('openapi')
                ->addDefaultsIfNotSet()
                ->children()
                    ->scalarNode('base_url')
                        ->defaultValue("'%env(resolve:OPEN_API_BASE_URL)%'")
                    ->end()
                ->end()
            ->end() 
        ->end();


        return $treeBuilder;
    }
}