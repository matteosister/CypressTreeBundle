<?php

namespace Cypress\TreeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
        $rootNode = $treeBuilder->root('cypress_tree');

        $rootNode
            ->children()
                ->arrayNode('trees')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                    ->children()
                        ->scalarNode('controller')->isRequired()->end()
                        ->scalarNode('label_template')->isRequired()->end()
                        ->booleanNode('editable_root')->defaultValue(false)->end()
                        ->scalarNode('theme')->defaultValue('default')->end()
                        ->scalarNode('assets_manager')->defaultValue('assetic')->end()
                        ->scalarNode('root_icon')->defaultValue('bundles/cypresstree/images/database.png')->end()
                        ->scalarNode('node_icon')->defaultValue('bundles/cypresstree/images/folder.png')->end()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}
