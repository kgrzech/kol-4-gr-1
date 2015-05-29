<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Bialystok;
use AppBundle\Form\BialystokType;

/**
 * Bialystok controller.
 *
 * @Route("/admin/bialystok")
 */
class BialystokController extends Controller
{

    /**
     * Lists all Bialystok entities.
     *
     * @Route("/", name="admin_bialystok")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Bialystok')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Bialystok entity.
     *
     * @Route("/", name="admin_bialystok_create")
     * @Method("POST")
     * @Template("AppBundle:Bialystok:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Bialystok();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bialystok_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Bialystok entity.
     *
     * @param Bialystok $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Bialystok $entity)
    {
        $form = $this->createForm(new BialystokType(), $entity, array(
            'action' => $this->generateUrl('admin_bialystok_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Bialystok entity.
     *
     * @Route("/new", name="admin_bialystok_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Bialystok();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Bialystok entity.
     *
     * @Route("/{id}", name="admin_bialystok_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bialystok')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bialystok entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Bialystok entity.
     *
     * @Route("/{id}/edit", name="admin_bialystok_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bialystok')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bialystok entity.');
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
    * Creates a form to edit a Bialystok entity.
    *
    * @param Bialystok $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bialystok $entity)
    {
        $form = $this->createForm(new BialystokType(), $entity, array(
            'action' => $this->generateUrl('admin_bialystok_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Bialystok entity.
     *
     * @Route("/{id}", name="admin_bialystok_update")
     * @Method("PUT")
     * @Template("AppBundle:Bialystok:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Bialystok')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bialystok entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_bialystok_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Bialystok entity.
     *
     * @Route("/{id}", name="admin_bialystok_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Bialystok')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bialystok entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_bialystok'));
    }

    /**
     * Creates a form to delete a Bialystok entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_bialystok_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
