<?php
/**
 * User: matteo
 * Date: 08/05/12
 * Time: 23.42
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Twig;

use Cypress\TreeBundle\Interfaces\TreeInterface,
    Cypress\TreeBundle\Tree\TreeCollection;

/**
 * Twig extension for tree bundle
 */
class TreeBundleExtension extends \Twig_Extension
{
    /**
    * @var \Twig_Environment
    */
    protected $environment;

    /**
     * @var TreeCollection
     */
    protected $treeCollection;

    /**
     * @var string
     */
    protected $assetsManager;

    /**
     * Class constructor
     *
     * @param \Twig_Environment                       $environment    twig environment
     * @param \Cypress\TreeBundle\Tree\TreeCollection $treeCollection TreeCollection instance
     */
    public function __construct(\Twig_Environment $environment, TreeCollection $treeCollection)
    {
        $this->environment = $environment;
        $this->treeCollection = $treeCollection;
    }

    /**
     * get the functions
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            'cypress_tree'             => new \Twig_Function_Method($this, 'tree', array('is_safe' => array('html'))),
            'cypress_tree_default'     => new \Twig_Function_Method($this, 'treeDefault', array('is_safe' => array('html'))),
            'cypress_tree_javascripts' => new \Twig_Function_Method($this, 'javascripts', array('is_safe' => array('html'))),
            'cypress_tree_javascripts_default' => new \Twig_Function_Method($this, 'javascriptsDefault', array('is_safe' => array('html'))),
            //'cypress_tree_stylesheets' => new \Twig_Function_Method($this, 'stylesheets', array('is_safe' => array('html')))
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'cypress_tree';
    }

    /**
     * renders a tree
     *
     * @param string                                       $treeName the tree name
     * @param \Cypress\TreeBundle\Interfaces\TreeInterface $node     a TreeInterface instance
     *
     * @return string
     */
    public function tree($treeName, $node)
    {
        $treeConfiguration = $this->getTreeConfiguration($treeName);
        $template = $this->environment->loadTemplate('CypressTreeBundle::tree.html.twig');
        return $template->render(array(
            'node' => $node,
            'conf' => $treeConfiguration
        ));
    }

    /**
     * renders a default tree
     *
     * @param \Cypress\TreeBundle\Interfaces\TreeInterface $node a TreeInterface instance
     *
     * @return string
     */
    public function treeDefault($node)
    {
        return $this->tree('__default', $node);
    }

    /**
     * output javascripts for tree
     *
     * @param string $treeName the tree name
     *
     * @internal param string $theme the jstree theme name
     *
     * @return string
     */
    public function javascripts($treeName)
    {
        $treeConfiguration = $this->getTreeConfiguration($treeName);
        $template = $this->environment->loadTemplate(sprintf('CypressTreeBundle::js/tree_javascripts_%s.html.twig', $treeConfiguration->assets_manager));
        return $template->render(array(
            'conf' => $treeConfiguration
        ));
    }

    /**
     * output javascripts for a default tree
     *
     * @internal param string $theme the jstree theme name
     *
     * @return string
     */
    public function javascriptsDefault()
    {
        return $this->javascripts('__default');
    }

    /**
     * output stylesheets for tree
     *
     * @param string $treeName the tree name
     *
     * @return string
     */
    public function stylesheets($treeName)
    {
        $template = $this->environment->loadTemplate(sprintf(
            'CypressTreeBundle::css/tree_stylesheets_%s.html.twig', $this->getTreeConfiguration($treeName)->assets_manager
        ));
        return $template->render(array());
    }

    /**
     * TreeConfiguration getter
     *
     * @param string $name tree name
     *
     * @return \Cypress\TreeBundle\Tree\TreeConfiguration
     */
    private function getTreeConfiguration($name)
    {
        return $this->treeCollection->getTree($name);
    }
}