<?php

namespace Ideo\DashBundle\Controller;

use Ideo\DashBundle\Entity\Cours;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Cour controller.
 *
 * @Route("cours")
 */
class CoursController extends Controller
{
    /**
     *
     *
     * @Route("/new", name="addCourse_new")
     * @Method({"GET", "POST"})
     */
    public function deployAction(DoceboApi $doceboApi)
    {
        $em = $this->getDoctrine()->getManager();
        $courses = $em->getRepository('AppBundle:addCourse')->findAll();

        $auth = $doceboApi->getAuthorization();

        // appel de l'api docebo /orgchart/getChildren
        $path_api = "/orgchart/getChildren";
        $post_fields = "{
                id_org: 0
            }";
        $child_array = $doceboApi->useDoceboApi($path_api,$post_fields,$auth);

        $children = $child_array['children'];


        return $this->render('addcourse/new.html.twig', array(
            'courses' => $courses,
            'children' => $children,
        ));
    }

    /**
     * Lists all cour entities.
     *
     * @Route("/", name="cours_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cours = $em->getRepository('IdeoDashBundle:Cours')->findAll();

        return $this->render('IdeoDashBundle:cours:index.html.twig', array(
            'cours' => $cours,
        ));
    }

    /**
     * Creates a new cour entity.
     *
     * @Route("/new", name="cours_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cour = new Cour();
        $form = $this->createForm('Ideo\DashBundle\Form\CoursType', $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cour);
            $em->flush();

            return $this->redirectToRoute('cours_show', array('id' => $cour->getId()));
        }

        return $this->render('IdeoDashBundle:cours:new.html.twig', array(
            'cour' => $cour,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cour entity.
     *
     * @Route("/{id}", name="cours_show")
     * @Method("GET")
     */
    public function showAction(Cours $cour)
    {
        $deleteForm = $this->createDeleteForm($cour);

        return $this->render('IdeoDashBundle:cours:show.html.twig', array(
            'cour' => $cour,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cour entity.
     *
     * @Route("/{id}/edit", name="cours_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Cours $cour)
    {
        $deleteForm = $this->createDeleteForm($cour);
        $editForm = $this->createForm('Ideo\DashBundle\Form\CoursType', $cour);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cours_edit', array('id' => $cour->getId()));
        }

        return $this->render('IdeoDashBundle:cours:edit.html.twig', array(
            'cour' => $cour,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cour entity.
     *
     * @Route("/{id}", name="cours_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Cours $cour)
    {
        $form = $this->createDeleteForm($cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cour);
            $em->flush();
        }

        return $this->redirectToRoute('cours_index');
    }

    /**
     * Creates a form to delete a cour entity.
     *
     * @param Cours $cour The cour entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Cours $cour)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cours_delete', array('id' => $cour->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
