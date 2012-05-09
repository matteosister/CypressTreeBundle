<?php
/**
 * User: matteo
 * Date: 23/03/12
 * Time: 15.01
 *
 * Just for fun...
 */

namespace Cypress\TreeBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

/**
 * Controller per NestedSet
 */
class NestedSetController extends CRUDController
{
    /**
     * Action per la lista
     *
     * @throws AccessDeniedException
     * @return Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();
        $roots = $this->getTreeRepository()->getRootNodes();

        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getListTemplate(), array(
            'action'     => 'list',
            'form'       => $formView,
            'roots'      => $roots,
            'repository' => $this->getTreeRepository()
        ));
    }

    /**
     * recupera il repository dell'entità
     *
     * @return NestedTreeRepository
     */
    public function getTreeRepository()
    {
        return $this->get('doctrine')->getEntityManager()->getRepository($this->admin->getClass());
    }
}
