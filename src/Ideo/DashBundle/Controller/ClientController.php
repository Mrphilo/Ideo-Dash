<?php

namespace Ideo\DashBundle\Controller;

use Ideo\DashBundle\Entity\Client;
use Ideo\DashBundle\Entity\Statistique;
use Ideo\DashBundle\IdeoDashBundle;
use Ideo\DashBundle\Service\DoceboApi;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Client controller.
 *
 * @Route("client")
 *
 */
class ClientController extends Controller
{

    /**
     * Updates Client and Statistique entities.
     *
     * @Route("/update", name="client_update")
     * @Method({"GET", "POST"})
     */
    public function updateDbAction(Request $request)
    {
        $doceboApi = new DoceboApi();
        $auth = $doceboApi->getAuthorization();
        $pathapi = "/orgchart/getchildren";
        $postfields="{id_org:0}";
        $children_array = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
        $children = $children_array['children'];

        $em = $this->getDoctrine()->getManager();

        $pathapi = "/orgchart/stats";

        foreach ($children as $child)
        {
            $id_org = $child['id_org'];

            $id_stat = $em->getRepository('IdeoDashBundle:Client')->findIdStatById($id_org);

            $postfields = "{
                    id_org: ".$child['id_org'].",
                    include_descendants: true,
                    from: 0,
                    count: 100
                }";
            $stats_array = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
            $stats = $stats_array['branches']['0']['stats'];

            if($id_stat)
            {
                $em->getRepository('IdeoDashBundle:Client')->updateClientStats($id_stat,$stats['total_users'],
                    $stats['course_enrollments'],$stats['course_enrollments_not_started'],$stats['course_enrollments_in_progress'],
                    $stats['course_enrollments_completed'],$stats['course_enrollments_expired']);
            }
            else
            {
                $stat = new Statistique();

                $stat->setTotalUsers($stats['total_users']);
                $stat->setCourseEnrollments($stats['course_enrollments']);
                $stat->setCourseEnrollmentsNotStarted($stats['course_enrollments_not_started']);
                $stat->setCourseEnrollmentsInProgress($stats['course_enrollments_in_progress']);
                $stat->setCourseEnrollmentsCompleted($stats['course_enrollments_completed']);
                $stat->setCourseEnrollmentsExpired($stats['course_enrollments_expired']);

                $em->persist($stat);
                $em->flush();

                $client = new Client();

                $client->setIdOrg($child['id_org']);
                $client->setCode($child['code']);
                $client->setNom($child['translation']['french']);
                $client->setIdStat($stat->getId());

                $em->persist($client);
                $em->flush();
            }
        }



        $clients = $em->getRepository('IdeoDashBundle:Client')->findClientInfoAndStats();

        return $this->render('IdeoDashBundle:client:index.html.twig', array(
            'clients' => $clients,
        ));
    }



    /**
     * Lists all client entities.
     *
     * @Route("/", name="client_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $clients = $em->getRepository('IdeoDashBundle:Client')->findClientInfoAndStats();

        return $this->render('IdeoDashBundle:client:index.html.twig', array(
            'clients' => $clients,
        ));
    }

    /**
     * Creates a new client entity.
     *
     * @Route("/new", name="client_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $client = new Client();
        $form = $this->createForm('Ideo\DashBundle\Form\ClientType', $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

           /* $doceboApi = new DoceboApi();
            $auth = $doceboApi->getAuthorization();
            $pathapi = "/orgchart/createNode";
            $postfields="{
                code: \"".$client->getCode()."\",
                translation: {
                    \"english\": \"".$client->getNom()."\",
                    \"french\": \"".$client->getNom()."\"
                },
                \"id_parent\": 0
            }";
            $response = $doceboApi->useDoceboApi($pathapi,$postfields,$auth);
            $id_org = $response['id_org'];
           */
            $id_org = 1111;
            $em = $this->getDoctrine()->getManager();
            $stat = new Statistique();
            $em->persist($stat);
            $em->flush();

            $client->setIdStat($stat->getId());
            $client->setIdOrg($id_org);


            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_show', array('id' => $client->getId()));
        }

        return $this->render('IdeoDashBundle:client:new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}", name="client_show")
     * @Method("GET")
     */
    public function showAction(Client $client)
    {

        $em = $this->get('doctrine');
        $info_client_and_stats = $em->getRepository('Ideo\DashBundle\Entity\Client')->findClientInfoAndStatsById($client->getId());

        $services = $em->getRepository('Ideo\DashBundle\Entity\Service')->findAll();
        $contrats = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findAll();

        if($client->getIdContrat() and $client->getIdService())
        {
            $service = $em->getRepository('Ideo\DashBundle\Entity\Service')->findServiceById($client->getIdService());
            $contrat = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findContratById($client->getIdContrat());



            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'service' => $service[0],
                'contrat' => $contrat[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        elseif ($client->getIdContrat())
        {
            $contrat = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findContratById($client->getIdContrat());

            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'contrat' => $contrat[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        elseif ($client->getIdService())
        {
            $service = $em->getRepository('Ideo\DashBundle\Entity\Service')->findServiceById($client->getIdService());

            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'service' => $service[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        else
        {
            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     * @Route("/{id}/edit", name="client_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('Ideo\DashBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_edit', array('id' => $client->getId()));
        }

        return $this->render('IdeoDashBundle:Client:edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     * @Route("/{id}/affect", name="client_affect")
     * @Method("POST")
     */
    public function affectAction(Client $client)
    {

        $em = $this->getDoctrine()->getManager();
        $info_client_and_stats = $em->getRepository('Ideo\DashBundle\Entity\Client')->findClientInfoAndStatsById($client->getId());
        $services = $em->getRepository('Ideo\DashBundle\Entity\Service')->findAll();
        $contrats = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findAll();

        if(isset($_POST['contrat']))
        {
            $contrat_libelle = $_POST['contrat'];

            foreach ($contrats as $item)
            {
                if($contrat_libelle == $item->getLibelle())
                {
                    $id_contrat = $item->getId();
                }
            }
            $client->setIdContrat($id_contrat);
            $em->persist($client);
            $em->flush();
        }

        if(isset($_POST['service']))
        {
            $service_libelle = $_POST['service'];

            foreach ($services as $item)
            {
                if($service_libelle == $item->getLibelle())
                {
                    $id_service = $item->getId();
                }
            }
            $client->setIdService($id_service);
            $em->persist($client);
            $em->flush();
        }

        if($client->getIdContrat() and $client->getIdService())
        {
            $service = $em->getRepository('Ideo\DashBundle\Entity\Service')->findServiceById($client->getIdService());
            $contrat = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findContratById($client->getIdContrat());

            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'service' => $service[0],
                'contrat' => $contrat[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        elseif ($client->getIdContrat())
        {
            $contrat = $em->getRepository('Ideo\DashBundle\Entity\Contrat')->findContratById($client->getIdContrat());

            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'contrat' => $contrat[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        elseif ($client->getIdService())
        {
            $service = $em->getRepository('Ideo\DashBundle\Entity\Service')->findServiceById($client->getIdService());

            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'service' => $service[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
        else
        {
            return $this->render('IdeoDashBundle:Client:show.html.twig', array(
                'client' => $info_client_and_stats[0],
                'services' => $services,
                'contrats' => $contrats,
            ));
        }
    }

    /**
     * Deletes a client entity.
     *
     * @Route("/{id}", name="client_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush();
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
