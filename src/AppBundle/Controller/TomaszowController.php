<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Tomaszow;
use AppBundle\Form\TomaszowType;

/**
 * Tomaszow controller.
 *
 * @Route("/admin/tomaszow")
 */
class TomaszowController extends Controller
{

    /**
     * Lists all Tomaszow entities.
     *
     * @Route("/", name="admin_tomaszow")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Tomaszow')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Tomaszow entity.
     *
     * @Route("/", name="admin_tomaszow_create")
     * @Method("POST")
     * @Template("AppBundle:Tomaszow:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Tomaszow();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tomaszow_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Tomaszow entity.
     *
     * @param Tomaszow $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Tomaszow $entity)
    {
        $form = $this->createForm(new TomaszowType(), $entity, array(
            'action' => $this->generateUrl('admin_tomaszow_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Tomaszow entity.
     *
     * @Route("/new", name="admin_tomaszow_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Tomaszow();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Tomaszow entity.
     *
     * @Route("/{id}", name="admin_tomaszow_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tomaszow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tomaszow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Tomaszow entity.
     *
     * @Route("/{id}/edit", name="admin_tomaszow_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tomaszow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tomaszow entity.');
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
    * Creates a form to edit a Tomaszow entity.
    *
    * @param Tomaszow $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Tomaszow $entity)
    {
        $form = $this->createForm(new TomaszowType(), $entity, array(
            'action' => $this->generateUrl('admin_tomaszow_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Tomaszow entity.
     *
     * @Route("/{id}", name="admin_tomaszow_update")
     * @Method("PUT")
     * @Template("AppBundle:Tomaszow:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Tomaszow')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Tomaszow entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_tomaszow_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tomaszow entity.
     *
     * @Route("/{id}", name="admin_tomaszow_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Tomaszow')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Tomaszow entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_tomaszow'));
    }

    /**
     * Creates a form to delete a Tomaszow entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_tomaszow_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
