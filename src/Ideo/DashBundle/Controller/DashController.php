<?php

namespace Ideo\DashBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * @Route("/dash")
 */
class DashController extends Controller
{
    /**
     * @Route("/home", name="_homepage")
     */
    public function homeAction()
    {
        return $this->render('IdeoDashBundle:Dash:home.html.twig');
    }

}
