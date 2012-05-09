<?php
/**
 * User: matteo
 * Date: 08/05/12
 * Time: 23.42
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Twig;

use Cypress\TreeBundle\Interfaces\TreeInterface;

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
     * @var \Cypress\TreeBundle\Router\TreeRouter
     */
    protected $router;

    /**
     * @var string
     */
    protected $defaultTheme;

    /**
     * @var string
     */
    protected $assetsManager;

    /**
     * Class constructor
     *
     * @param \Twig_Environment $environment twig environment
     */
    public function __construct(\Twig_Environment $environment, $router, $assetsManager)
    {
        $this->environment = $environment;
        $this->router = $router;
        $this->assetsManager = $assetsManager;
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
            'cypress_tree_javascripts' => new \Twig_Function_Method($this, 'javascripts', array('is_safe' => array('html'))),
            'cypress_tree_stylesheets' => new \Twig_Function_Method($this, 'stylesheets', array('is_safe' => array('html'))),
            'cypress_tree_node_route'  => new \Twig_Function_Method($this, 'route', array('is_safe' => array('html'))),
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
     * @param \Cypress\TreeBundle\Interfaces\TreeInterface $node a TreeInterface instance
     *
     * @return string
     */
    public function tree(TreeInterface $node)
    {
        $template = $this->environment->loadTemplate('CypressTreeBundle::tree.html.twig');
        return $template->render(array(
            'node' => $node
        ));
    }

    /**
     * output javascripts for tree
     *
     * @param string $type  the assets management type (plain or assetic)
     * @param string $theme the jstree theme name
     *
     * @return string
     */
    public function javascripts()
    {
        $template = $this->environment->loadTemplate(sprintf('CypressTreeBundle::js/tree_javascripts_%s.html.twig', $this->assetsManager));
        return $template->render(array(
            'theme' => $this->defaultTheme
        ));
    }

    /**
     * output stylesheets for tree
     *
     * @param string $type the assets management type (plain or assetic)
     *
     * @return string
     */
    public function stylesheets($type = 'plain')
    {
        $template = $this->environment->loadTemplate(sprintf('CypressTreeBundle::css/tree_stylesheets_%s.html.twig', $type));
        return $template->render(array());
    }

    public function route($obj)
    {
        return $this->router->generateRoute($obj);
    }

    /**
     * defaultTheme setter
     *
     * @param string $theme the default theme
     */
    public function setDefaultTheme($theme)
    {
        $this->defaultTheme = $theme;
    }
}