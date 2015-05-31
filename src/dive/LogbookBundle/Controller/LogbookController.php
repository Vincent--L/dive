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
    
    public function viewDiveAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $dive = $em->getRepository('diveLogbookBundle:Dive')->find($id);
        if (null === $dive){
            throw new NotFoundHttpException("Dive n°".$id." does not exist.");
        }
        
        $formEdit = $this->get('form.factory')->createNamedBuilder('formEdit', new DiveType(), $dive)->getForm();
        $formDelete = $this->get('form.factory')->createNamedBuilder('formDelete')->getForm();
        
        if($request->request->has('formEdit')){
            if($formEdit->handleRequest($request)->isValid()){
                $em->flush();
                return $this->redirect($this->generateUrl('dive_logbook_viewDive', array(
                    'id' => $dive->getId()
                )));
            }
        }
        
        if($request->request->has('formDelete')){
            if($formDelete->handleRequest($request)->isValid()){
                $em->remove($dive);
                $em->flush();            
                return $this->redirectToRoute('dive_logbook_view');
            }
        }
        
        return $this->render('diveLogbookBundle:Default:viewDive.html.twig', array(
            'dive' => $dive,
            'formEdit' => $formEdit->createView(),
            'formDelete' => $formDelete->createView()
        ));
    }
}
