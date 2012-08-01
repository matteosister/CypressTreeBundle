<?php
/**
 * User: matteo
 * Date: 08/05/12
 * Time: 23.56
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Interfaces;

/**
 * Interface for trees
 */
interface TreeInterface
{
    /**
     * returns a in iteratable object of children
     *
     * @abstract
     * @return mixed
     */
    function getChildren();
}
