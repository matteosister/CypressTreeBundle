<?php
/**
 * User: matteo
 * Date: 18/05/12
 * Time: 17.00
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response;
use Cypress\TreeBundle\Interfaces\TreeControllerSortableInterface;

class DefaultController extends Controller implements TreeControllerSortableInterface
{
    /**
     * Controller action to move a tree node
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response must return a Response object with:
     *     "ok": everything worked
     *     "ko": there was a problem
     */
    function sortNodeAction()
    {
        return new Response('ko');
    }
}
