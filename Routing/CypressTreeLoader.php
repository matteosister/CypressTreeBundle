<?php
/**
 * User: matteo
 * Date: 11/05/12
 * Time: 14.19
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Routing;

use Symfony\Component\Config\Loader\LoaderInterface,
    Symfony\Component\Config\Loader\LoaderResolver,
    Symfony\Component\Config\Loader\LoaderResolverInterface,
    Symfony\Component\Routing\Route,
    Symfony\Component\Routing\RouteCollection;

use Cypress\TreeBundle\Tree\TreeCollection;

/**
 * Class to register the custom routes for the CypressTree bundle
 */
class CypressTreeLoader implements LoaderInterface
{
    /**
     * @var bool
     */
    private $loaded = false;

    /**
     * @var array
     */
    private $trees;

    /**
     * class constructor
     *
     * @param \Cypress\TreeBundle\Tree\TreeCollection $trees
     */
    public function __construct(TreeCollection $trees)
    {
        $this->trees = $trees;
    }

    /**
     * Loads a resource.
     *
     * @param mixed  $resource The resource
     * @param string $type     The resource type
     *
     * @return \Symfony\Component\Routing\RouteCollection
     * @throws \RuntimeException
     */
    public function load($resource, $type = null)
    {
        if (true === $this->loaded) {
            throw new \RuntimeException('You\'ve added the cypress_tree route configuration more than once!');
        }
        $routes = new RouteCollection();
        foreach ($this->trees as $treeConfiguration) {
            $pattern = sprintf('/ajax/%s/sort', $treeConfiguration->getName());
            $defaults = array(
                '_controller' => sprintf('%s:%s', $treeConfiguration->controller, 'sortNode')
            );
            $route = new Route($pattern, $defaults);
            $routes->add(sprintf('_cypress_tree_%s_ajax_sort', $treeConfiguration->getName()), $route);
        }

        return $routes;
    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed  $resource A resource
     * @param string $type     The resource type
     *
     * @return Boolean true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'cypress_tree' === $type;
    }

    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
    }

    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolverInterface $resolver A LoaderResolverInterface instance
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}
