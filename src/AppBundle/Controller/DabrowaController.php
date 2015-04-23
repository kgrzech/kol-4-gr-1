<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Dabrowa;
use AppBundle\Form\DabrowaType;

/**
 * Dabrowa controller.
 *
 * @Route("/admin/dabrowa")
 */
class DabrowaController extends Controller
{

    /**
     * Lists all Dabrowa entities.
     *
     * @Route("/", name="admin_dabrowa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Dabrowa')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Dabrowa entity.
     *
     * @Route("/", name="admin_dabrowa_create")
     * @Method("POST")
     * @Template("AppBundle:Dabrowa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Dabrowa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dabrowa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Dabrowa entity.
     *
     * @param Dabrowa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Dabrowa $entity)
    {
        $form = $this->createForm(new DabrowaType(), $entity, array(
            'action' => $this->generateUrl('admin_dabrowa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Dabrowa entity.
     *
     * @Route("/new", name="admin_dabrowa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Dabrowa();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Dabrowa entity.
     *
     * @Route("/{id}", name="admin_dabrowa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dabrowa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dabrowa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Dabrowa entity.
     *
     * @Route("/{id}/edit", name="admin_dabrowa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dabrowa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dabrowa entity.');
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
    * Creates a form to edit a Dabrowa entity.
    *
    * @param Dabrowa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Dabrowa $entity)
    {
        $form = $this->createForm(new DabrowaType(), $entity, array(
            'action' => $this->generateUrl('admin_dabrowa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Dabrowa entity.
     *
     * @Route("/{id}", name="admin_dabrowa_update")
     * @Method("PUT")
     * @Template("AppBundle:Dabrowa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Dabrowa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Dabrowa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_dabrowa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Dabrowa entity.
     *
     * @Route("/{id}", name="admin_dabrowa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Dabrowa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Dabrowa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_dabrowa'));
    }

    /**
     * Creates a form to delete a Dabrowa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_dabrowa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
