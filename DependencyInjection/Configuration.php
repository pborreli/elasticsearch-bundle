<?php

namespace Ushios\Bundle\ElasticSearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Monolog\Logger;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ushios_elastic_search');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        
        $rootNode
            ->children()
                ->arrayNode('client')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('class')
                            ->defaultValue('Elasticsearch\Client')
                        ->end()
                        ->arrayNode('hosts')
                            ->prototype('scalar')
                            ->end()
                        ->end()
                        ->scalarNode('log_path')
                            ->defaultValue('elasticsearch.log')
                        ->end()
                        ->scalarNode('log_level')
                            ->defaultValue(Logger::WARNING)
                        ->end()
                    ->end()
                ->end()
            ->end();
                    

        return $treeBuilder;
    }
}
