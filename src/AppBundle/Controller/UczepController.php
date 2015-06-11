<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Uczep;
use AppBundle\Form\UczepType;

/**
 * Uczep controller.
 *
 * @Route("/admin/uczep")
 */
class UczepController extends Controller
{

    /**
     * Lists all Uczep entities.
     *
     * @Route("/", name="admin_uczep")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Uczep')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Uczep entity.
     *
     * @Route("/", name="admin_uczep_create")
     * @Method("POST")
     * @Template("AppBundle:Uczep:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Uczep();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_uczep_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Uczep entity.
     *
     * @param Uczep $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Uczep $entity)
    {
        $form = $this->createForm(new UczepType(), $entity, array(
            'action' => $this->generateUrl('admin_uczep_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Uczep entity.
     *
     * @Route("/new", name="admin_uczep_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Uczep();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Uczep entity.
     *
     * @Route("/{id}", name="admin_uczep_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Uczep')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uczep entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Uczep entity.
     *
     * @Route("/{id}/edit", name="admin_uczep_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Uczep')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uczep entity.');
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
    * Creates a form to edit a Uczep entity.
    *
    * @param Uczep $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Uczep $entity)
    {
        $form = $this->createForm(new UczepType(), $entity, array(
            'action' => $this->generateUrl('admin_uczep_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Uczep entity.
     *
     * @Route("/{id}", name="admin_uczep_update")
     * @Method("PUT")
     * @Template("AppBundle:Uczep:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Uczep')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Uczep entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_uczep_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Uczep entity.
     *
     * @Route("/{id}", name="admin_uczep_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Uczep')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Uczep entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_uczep'));
    }

    /**
     * Creates a form to delete a Uczep entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_uczep_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
