<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Lublin;
use AppBundle\Form\LublinType;

/**
 * Lublin controller.
 *
 * @Route("/admin/lublin")
 */
class LublinController extends Controller
{

    /**
     * Lists all Lublin entities.
     *
     * @Route("/", name="admin_lublin")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Lublin')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Lublin entity.
     *
     * @Route("/", name="admin_lublin_create")
     * @Method("POST")
     * @Template("AppBundle:Lublin:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Lublin();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_lublin_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Lublin entity.
     *
     * @param Lublin $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Lublin $entity)
    {
        $form = $this->createForm(new LublinType(), $entity, array(
            'action' => $this->generateUrl('admin_lublin_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Lublin entity.
     *
     * @Route("/new", name="admin_lublin_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Lublin();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Lublin entity.
     *
     * @Route("/{id}", name="admin_lublin_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Lublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lublin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Lublin entity.
     *
     * @Route("/{id}/edit", name="admin_lublin_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Lublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lublin entity.');
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
    * Creates a form to edit a Lublin entity.
    *
    * @param Lublin $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Lublin $entity)
    {
        $form = $this->createForm(new LublinType(), $entity, array(
            'action' => $this->generateUrl('admin_lublin_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Lublin entity.
     *
     * @Route("/{id}", name="admin_lublin_update")
     * @Method("PUT")
     * @Template("AppBundle:Lublin:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Lublin')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lublin entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_lublin_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Lublin entity.
     *
     * @Route("/{id}", name="admin_lublin_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Lublin')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lublin entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_lublin'));
    }

    /**
     * Creates a form to delete a Lublin entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_lublin_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
