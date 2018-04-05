<?php

namespace Ideo\DashBundle\Controller;

use Ideo\DashBundle\Entity\Projet;
use Ideo\DashBundle\Entity\Statistique;
use Ideo\DashBundle\Service\DoceboApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Projet controller.
 *
 * @Route("projet")
 */
class ProjetController extends Controller
{
    /**
     * Updates Projects and Statistiques entities.
     *
     * @Route("/Update-la-liste-des-Projets", name="projet_update")
     * @Method({"GET", "POST"})
     */
    public function updateDbAction()
    {
        $doceboApi = new DoceboApi();
        $auth = $doceboApi->getAuthorization();
        $pathapi = "/orgchart/getchildren";
        $postfields="{id_org:0}";
        $children_array = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
        $children = $children_array['children'];

        $em = $this->get('doctrine.orm.entity_manager');

        $pathapi = "/orgchart/stats";

        foreach ($children as $child)
        {
            $id_org = $child['id_org'];
            $postfields = "{
                    id_org: ".$id_org.",
                    include_descendants: true,
                    from: 0,
                    count: 100
                }";
            $projects_array = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
            $projects = $projects_array['branches'];

            for($i=1;$i < count($projects);$i++)
            {
                $id_projet = $projects[$i]['id_org'];
                $id_stat = $em->getRepository('IdeoDashBundle:Projet')->findIdStatById($id_projet);

                if($id_stat)
                {
                    $em->getRepository('IdeoDashBundle:Projet')->updateProjetStats($id_stat,$projects[$i]['stats']['total_users'],
                        $projects[$i]['stats']['course_enrollments'],$projects[$i]['stats']['course_enrollments_not_started'],$projects[$i]['stats']['course_enrollments_in_progress'],
                        $projects[$i]['stats']['course_enrollments_completed'],$projects[$i]['stats']['course_enrollments_expired']);
                }
                else
                {
                    $stat = new Statistique();

                    $stat->setTotalUsers($projects[$i]['stats']['total_users']);
                    $stat->setCourseEnrollments($projects[$i]['stats']['course_enrollments']);
                    $stat->setCourseEnrollmentsNotStarted($projects[$i]['stats']['course_enrollments_not_started']);
                    $stat->setCourseEnrollmentsInProgress($projects[$i]['stats']['course_enrollments_in_progress']);
                    $stat->setCourseEnrollmentsCompleted($projects[$i]['stats']['course_enrollments_completed']);
                    $stat->setCourseEnrollmentsExpired($projects[$i]['stats']['course_enrollments_expired']);

                    $em->persist($stat);
                    $em->flush();

                    $projet = new Projet();

                    $projet->setIdProjet($id_projet);
                    $projet->setCode($projects[$i]['code']);
                    $projet->setNom($projects[$i]['translation']['french']);
                    $projet->setIdStat($stat->getId());
                    $projet->setClientId($id_org);

                    $em->persist($projet);
                    $em->flush();
                }

            }
        }

        $projectsdb = $em->getRepository('IdeoDashBundle:Projet')->findProjetInfoAndStats();

        return $this->render('IdeoDashBundle:projet:index.html.twig', array(
            'projets' => $projectsdb,
        ));
    }


    /**
     * Lists all projet entities.
     *
     * @Route("/liste-des-projets", name="projet_list")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('IdeoDashBundle:Projet')->findAll();

        return $this->render('IdeoDashBundle:projet:index.html.twig', array(
            'projets' => $projets,
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/nouveau-projet", name="projet_new")
     */
    public function newAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $projet = new Projet();
        $form = $this->createForm('Ideo\DashBundle\Form\ProjetType', $projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client = $projet->getClient();
            $id_org = $client->getIdOrg();

            $doceboApi = new DoceboApi();
            $auth = $doceboApi->getAuthorization();
            $pathapi = "/orgchart/createNode";
            $postfields="{
                code: \"".$projet->getCode()."\",
                translation: {
                    \"english\": \"".$projet->getNom()."\",
                    \"french\": \"".$projet->getNom()."\"
                },
                \"id_parent\": ".$id_org."
            }";
            $response = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
            $id_projet = $response['id_org'];

            $projet->setIdProjet($id_projet);

            $stat = new Statistique();
            $em->persist($stat);
            $em->flush();

            $projet->setIdStat($stat->getId());

            $em->persist($projet);
            $em->flush();

            return $this->redirectToRoute('projet_show', array('id' => $projet->getId()));
        }

        return $this->render('IdeoDashBundle:projet:new.html.twig', array(
            'projet' => $projet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new projet entity.
     *
     * @Route("/affect", name="projet_affect")
     * @Method({"GET", "POST"})
     */
    public function affectAction(Request $request)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $clients = $em->getRepository('Ideo\DashBundle\Entity\Client')->findAll();

        return $this->render('IdeoDashBundle:projet:affect.html.twig', array(
            'clients' => $clients,
        ));
    }


    /**
     * Finds and displays a projet entity.
     *
     * @Route("/{id}", name="projet_show")
     * @Method("GET")
     */
    public function showAction(Projet $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);

        return $this->render('IdeoDashBundle:projet:show.html.twig', array(
            'projet' => $projet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projet entity.
     *
     * @Route("/{id}/edit", name="projet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Projet $projet)
    {
        $deleteForm = $this->createDeleteForm($projet);
        $editForm = $this->createForm('Ideo\DashBundle\Form\ProjetType', $projet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projet_edit', array('id' => $projet->getId()));
        }

        return $this->render('IdeoDashBundle:projet:edit.html.twig', array(
            'projet' => $projet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a projet entity.
     *
     * @Route("/{id}", name="projet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Projet $projet)
    {
        $form = $this->createDeleteForm($projet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projet);
            $em->flush();
        }

        return $this->redirectToRoute('projet_index');
    }

    /**
     * Creates a form to delete a projet entity.
     *
     * @param Projet $projet The projet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Projet $projet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('projet_delete', array('id' => $projet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
