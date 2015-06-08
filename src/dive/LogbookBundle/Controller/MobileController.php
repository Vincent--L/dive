<?php

namespace dive\LogbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MobileController extends Controller
{
    public function logbookAction()
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $repository = $this->getDoctrine()->getManager()->getRepository('diveLogbookBundle:Dive');
        $logbook = $repository->findByDiver($userId);
       
        $response = new Response($this->render('diveLogbookBundle:Mobile:logbook.xml.twig', array(
            'logbook' => $logbook,
        )));
        $response->headers->set('Content-Type', 'xml');
        return $response;
    }
}