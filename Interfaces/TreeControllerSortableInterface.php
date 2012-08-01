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
     * @param int $node id of the node to move
     * @param int $ref  id of the reference node
     * @param int $move 1 to move after, 0 to move before the reference
     *
     * @return \Symfony\Component\HttpFoundation\Response must return a Response object with:
     *     "ok": everything worked
     *     "ko": there was a problem
     */
    function sortNodeAction($node, $ref, $move);
}
