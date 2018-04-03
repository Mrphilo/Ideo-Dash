<?php

namespace Ideo\DashBundle\Controller;

use Ideo\DashBundle\Entity\Apprenant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Apprenant controller.
 *
 * @Route("apprenant")
 */
class ApprenantController extends Controller
{
    /**
     * Lists all apprenant entities.
     *
     * @Route("/", name="apprenant_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $apprenants = $em->getRepository('IdeoDashBundle:Apprenant')->findAll();

        return $this->render('IdeoDashBundle:apprenant:index.html.twig', array(
            'apprenants' => $apprenants,
        ));
    }

    /**
     * Creates a new apprenant entity.
     *
     * @Route("/new", name="apprenant_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $apprenant = new Apprenant();
        $form = $this->createForm('Ideo\DashBundle\Form\ApprenantType', $apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($apprenant);
            $em->flush();

            return $this->redirectToRoute('apprenant_show', array('id' => $apprenant->getId()));
        }

        return $this->render('IdeoDashBundle:apprenant:new.html.twig', array(
            'apprenant' => $apprenant,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a apprenant entity.
     *
     * @Route("/{id}", name="apprenant_show")
     * @Method("GET")
     */
    public function showAction(Apprenant $apprenant)
    {
        $deleteForm = $this->createDeleteForm($apprenant);

        return $this->render('IdeoDashBundle:apprenant:show.html.twig', array(
            'apprenant' => $apprenant,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing apprenant entity.
     *
     * @Route("/{id}/edit", name="apprenant_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Apprenant $apprenant)
    {
        $deleteForm = $this->createDeleteForm($apprenant);
        $editForm = $this->createForm('Ideo\DashBundle\Form\ApprenantType', $apprenant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('apprenant_edit', array('id' => $apprenant->getId()));
        }

        return $this->render('IdeoDashBundle:apprenant:edit.html.twig', array(
            'apprenant' => $apprenant,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a apprenant entity.
     *
     * @Route("/{id}", name="apprenant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Apprenant $apprenant)
    {
        $form = $this->createDeleteForm($apprenant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($apprenant);
            $em->flush();
        }

        return $this->redirectToRoute('apprenant_index');
    }

    /**
     * Creates a form to delete a apprenant entity.
     *
     * @param Apprenant $apprenant The apprenant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Apprenant $apprenant)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('apprenant_delete', array('id' => $apprenant->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
