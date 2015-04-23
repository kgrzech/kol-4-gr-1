<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Narol;
use AppBundle\Form\NarolType;

/**
 * Narol controller.
 *
 * @Route("/admin/narol")
 */
class NarolController extends Controller
{

    /**
     * Lists all Narol entities.
     *
     * @Route("/", name="admin_narol")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Narol')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Narol entity.
     *
     * @Route("/", name="admin_narol_create")
     * @Method("POST")
     * @Template("AppBundle:Narol:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Narol();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_narol_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Narol entity.
     *
     * @param Narol $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Narol $entity)
    {
        $form = $this->createForm(new NarolType(), $entity, array(
            'action' => $this->generateUrl('admin_narol_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Narol entity.
     *
     * @Route("/new", name="admin_narol_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Narol();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Narol entity.
     *
     * @Route("/{id}", name="admin_narol_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Narol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Narol entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Narol entity.
     *
     * @Route("/{id}/edit", name="admin_narol_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Narol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Narol entity.');
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
    * Creates a form to edit a Narol entity.
    *
    * @param Narol $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Narol $entity)
    {
        $form = $this->createForm(new NarolType(), $entity, array(
            'action' => $this->generateUrl('admin_narol_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Narol entity.
     *
     * @Route("/{id}", name="admin_narol_update")
     * @Method("PUT")
     * @Template("AppBundle:Narol:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Narol')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Narol entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_narol_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Narol entity.
     *
     * @Route("/{id}", name="admin_narol_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Narol')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Narol entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_narol'));
    }

    /**
     * Creates a form to delete a Narol entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_narol_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
