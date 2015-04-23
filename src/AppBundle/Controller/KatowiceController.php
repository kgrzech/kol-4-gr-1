<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Katowice;
use AppBundle\Form\KatowiceType;

/**
 * Katowice controller.
 *
 * @Route("/admin/katowice")
 */
class KatowiceController extends Controller
{

    /**
     * Lists all Katowice entities.
     *
     * @Route("/", name="admin_katowice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Katowice')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Katowice entity.
     *
     * @Route("/", name="admin_katowice_create")
     * @Method("POST")
     * @Template("AppBundle:Katowice:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Katowice();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_katowice_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Katowice entity.
     *
     * @param Katowice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Katowice $entity)
    {
        $form = $this->createForm(new KatowiceType(), $entity, array(
            'action' => $this->generateUrl('admin_katowice_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Katowice entity.
     *
     * @Route("/new", name="admin_katowice_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Katowice();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Katowice entity.
     *
     * @Route("/{id}", name="admin_katowice_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Katowice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Katowice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Katowice entity.
     *
     * @Route("/{id}/edit", name="admin_katowice_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Katowice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Katowice entity.');
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
    * Creates a form to edit a Katowice entity.
    *
    * @param Katowice $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Katowice $entity)
    {
        $form = $this->createForm(new KatowiceType(), $entity, array(
            'action' => $this->generateUrl('admin_katowice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Katowice entity.
     *
     * @Route("/{id}", name="admin_katowice_update")
     * @Method("PUT")
     * @Template("AppBundle:Katowice:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Katowice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Katowice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_katowice_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Katowice entity.
     *
     * @Route("/{id}", name="admin_katowice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Katowice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Katowice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_katowice'));
    }

    /**
     * Creates a form to delete a Katowice entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_katowice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
