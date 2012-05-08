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

    public function __construct(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    public function getFunctions()
    {
        return array(
            'cypress_tree'        => new \Twig_Function_Method($this, 'tree', array('is_safe' => array('html'))),
            'cypress_javascripts' => new \Twig_Function_Method($this, 'javascripts', array('is_safe' => array('html'))),
            'cypress_stylesheets' => new \Twig_Function_Method($this, 'stylesheets', array('is_safe' => array('html')))
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

    public function tree(TreeInterface $node) {
        $template = $this->environment->loadTemplate('CypressTreeBundle::tree.html.twig');
        return $template->render(array(
            'node' => $node
        ));
    }

    public function javascripts($type = 'plain', $theme = 'default')
    {
        $template = $this->environment->loadTemplate(sprintf('CypressTreeBundle::js/tree_javascripts_%s.html.twig', $type));
        return $template->render(array(
            'theme' => $theme
        ));
    }

    public function stylesheets($type = 'plain')
    {
        $template = $this->environment->loadTemplate(sprintf('CypressTreeBundle::css/tree_stylesheets_%s.html.twig', $type));
        return $template->render(array());
    }
}