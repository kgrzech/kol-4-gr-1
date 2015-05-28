<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\bruksela;
use AppBundle\Form\brukselaType;

/**
 * bruksela controller.
 *
 * @Route("/admin/bruksela")
 */
class brukselaController extends Controller
{

    /**
     * Lists all bruksela entities.
     *
     * @Route("/", name="admin_bruksela")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:bruksela')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new bruksela entity.
     *
     * @Route("/", name="admin_bruksela_create")
     * @Method("POST")
     * @Template("AppBundle:bruksela:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new bruksela();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bruksela_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a bruksela entity.
     *
     * @param bruksela $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(bruksela $entity)
    {
        $form = $this->createForm(new brukselaType(), $entity, array(
            'action' => $this->generateUrl('admin_bruksela_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new bruksela entity.
     *
     * @Route("/new", name="admin_bruksela_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new bruksela();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a bruksela entity.
     *
     * @Route("/{id}", name="admin_bruksela_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:bruksela')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find bruksela entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing bruksela entity.
     *
     * @Route("/{id}/edit", name="admin_bruksela_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:bruksela')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find bruksela entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a bruksela entity.
    *
    * @param bruksela $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(bruksela $entity)
    {
        $form = $this->createForm(new brukselaType(), $entity, array(
            'action' => $this->generateUrl('admin_bruksela_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing bruksela entity.
     *
     * @Route("/{id}", name="admin_bruksela_update")
     * @Method("PUT")
     * @Template("AppBundle:bruksela:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:bruksela')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find bruksela entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bruksela_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a bruksela entity.
     *
     * @Route("/{id}", name="admin_bruksela_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:bruksela')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find bruksela entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_bruksela'));
    }

    /**
     * Creates a form to delete a bruksela entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bruksela_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
