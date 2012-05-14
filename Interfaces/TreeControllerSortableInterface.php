<?php
/**
 * User: matteo
 * Date: 11/05/12
 * Time: 12.37
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Interfaces;

use Cypress\TreeBundle\Interfaces\TreeInterface;

/**
 * TreeControllerInterface
 */
interface TreeControllerSortableInterface
{
    /**
     * Controller action to move a tree node
     *
     * @abstract
     *
     * @return \Symfony\Component\HttpFoundation\Response must return a Response object with:
     *     "ok": everything worked
     *     "ko": there was a problem
     */
    function sortNodeAction();
}
