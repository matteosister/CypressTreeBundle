<?php
/**
 * User: matteo
 * Date: 10/05/12
 * Time: 0.08
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Router;

/**
 * tree router
 */
class TreeRouter
{
    private $router;

    /**
     * Constructor
     *
     * @param RouterInterface $router a router
     */
    public function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * returns a route to a node tree
     *
     * @param mixed $obj the object to generate the route for
     *
     * @return string
     */
    public function generateRoute($obj)
    {
        return 'test';
    }
}
