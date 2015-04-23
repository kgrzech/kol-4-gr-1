<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\hel;
use AppBundle\Form\helType;

/**
 * hel controller.
 *
 * @Route("/admin/hel")
 */
class helController extends Controller
{

    /**
     * Lists all hel entities.
     *
     * @Route("/", name="admin_hel")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:hel')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new hel entity.
     *
     * @Route("/", name="admin_hel_create")
     * @Method("POST")
     * @Template("AppBundle:hel:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new hel();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_hel_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a hel entity.
     *
     * @param hel $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(hel $entity)
    {
        $form = $this->createForm(new helType(), $entity, array(
            'action' => $this->generateUrl('admin_hel_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new hel entity.
     *
     * @Route("/new", name="admin_hel_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new hel();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a hel entity.
     *
     * @Route("/{id}", name="admin_hel_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:hel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find hel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing hel entity.
     *
     * @Route("/{id}/edit", name="admin_hel_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:hel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find hel entity.');
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
    * Creates a form to edit a hel entity.
    *
    * @param hel $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(hel $entity)
    {
        $form = $this->createForm(new helType(), $entity, array(
            'action' => $this->generateUrl('admin_hel_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing hel entity.
     *
     * @Route("/{id}", name="admin_hel_update")
     * @Method("PUT")
     * @Template("AppBundle:hel:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:hel')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find hel entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_hel_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a hel entity.
     *
     * @Route("/{id}", name="admin_hel_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:hel')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find hel entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_hel'));
    }

    /**
     * Creates a form to delete a hel entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_hel_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
