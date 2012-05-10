<?php
/**
 * User: matteo
 * Date: 10/05/12
 * Time: 22.34
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Tree;

use Cypress\TreeBundle\Tree\TreeConfiguration;

/**
 * A collection of trees
 */
class TreeCollection
{
    /**
     * @var array an array of Tree instances
     */
    private $trees;

    /**
     * Class constructor
     *
     * @param array $config dependency injection configuration
     */
    public function __construct($config)
    {
        foreach ($config['trees'] as $name => $treeConfig) {
            $this->buildTree($name, $treeConfig);
        }
    }

    /**
     * a config part representing a single tree
     *
     * @param string $name   tree name
     * @param array  $config dependency injection configuration
     */
    protected function buildTree($name, $config)
    {
        $this->trees[] = new TreeConfiguration($name, $config);
    }

    /**
     * retrieve a tree by name
     *
     * @param string $name tree name
     *
     * @return TreeConfiguration
     */
    public function getTree($name)
    {
        $filtered = array_filter($this->trees, function(TreeConfiguration $tree) use ($name) {
            return $name == $tree->getName();
        });
        return $filtered[0];
    }
}
