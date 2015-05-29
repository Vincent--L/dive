<?php

namespace dive\LogbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use dive\LogbookBundle\Entity\Dive;
use dive\LogbookBundle\Form\DiveType;

class LogbookController extends Controller
{
    public function viewAction(Request $request)
    {
        $user = $this->getUser();
        $userId = $user->getId();
        $repository = $this->getDoctrine()->getManager()->getRepository('diveLogbookBundle:Dive');
        $logbook = $repository->findByDiver($userId);
        
        $dive = new Dive();
        $dive->setDiver($user);
        $form = $this->get('form.factory')->create(new DiveType(), $dive);
        if($form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($dive);
            $em->flush();
            
            return $this->redirectToRoute('dive_logbook_view');
        }
        
        return $this->render('diveLogbookBundle:Default:logbook.html.twig', array(
            'logbook' => $logbook,
            'form' => $form->createView(),
        ));
    }
}
