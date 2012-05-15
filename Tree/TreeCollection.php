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
class TreeCollection implements \ArrayAccess, \Iterator, \Countable
{
    /**
     * @var array an array of Tree instances
     */
    private $trees;

    /**
     * @var int useful for ArrayAccess
     */
    private $position;

    /**
     * Class constructor
     *
     * @param array $config dependency injection configuration
     */
    public function __construct($config)
    {
        $this->position = 0;
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
        if (0 === count($filtered)) {
            throw new \InvalidArgumentException(sprintf('the tree %s do not exists in your configuration'));
        }
        sort($filtered);
        return $filtered[0];
    }


    /**
     * {@inheritDoc}
     */
    public function current()
    {
        return $this->trees[$this->position];
    }

    /**
     * {@inheritDoc}
     */
    public function next()
    {
        $this->position++;
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function valid()
    {
        return isset($this->trees[$this->position]);
    }

    /**
     * {@inheritDoc}
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset An offset to check for.
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->trees[$offset]);
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to retrieve.
     *
     * @return mixed Can return all value types.
     */
    public function offsetGet($offset)
    {
        return isset($this->trees[$offset]) ? $this->trees[$offset] : null;
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->trees[] = $value;
        } else {
            $this->trees[$offset] = $value;
        }
    }

    /**
     * {@inheritDoc}
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->trees[$offset]);
    }

    /**
     * {@inheritDoc}
     *
     * @return int
     */
    public function count()
    {
        return count($this->trees);
    }


}
