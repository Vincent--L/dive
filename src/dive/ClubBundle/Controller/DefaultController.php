<?php

namespace dive\ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('diveClubBundle:Default:index.html.twig', array('name' => $name));
    }
}
