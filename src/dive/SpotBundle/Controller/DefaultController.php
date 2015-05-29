<?php

namespace dive\SpotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use dive\SpotBundle\Entity\Spot;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function viewAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('diveSpotBundle:Spot');
        $spot = $repository->find($id);
        
        return $this->render('diveSpotBundle:Default:viewSpot.html.twig', array('spot' => $spot));
    }
    
    public function listAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('diveSpotBundle:Spot');
        $listSpot = $repository->findAll();
        return $this->render('diveSpotBundle:Default:listSpot.html.twig', array('listSpot' => $listSpot));
    }
    
    public function addAction(Request $request)
    {      
        $spot = new Spot();

        $formBuilder = $this->get('form.factory')->createBuilder('form', $spot);

        $formBuilder
          ->add('name',        'text')
          ->add('country',    'country', array(
                'placeholder' => ''
            ))
          ->add('lattitude',   'number', array(
                'precision' => 6
            ))
          ->add('longitude',   'number', array(
                'precision' => 6
            ))
          ->add('maxDepth',    'integer', array(
                'attr' => array('min' => 5, 'max' => 150)
            ))
          ->add('description', 'textarea')
          ->add('save',        'submit')
        ;

        $form = $formBuilder->getForm();
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spot);
            $em->flush();
            
            // $request->getSession()->getFlashBag()->add('notice', 'Spot successfully added.');
            return $this->redirect($this->generateUrl('dive_spot_view', array('id' => $spot->getId())));
        }

        return $this->render('diveSpotBundle:Default:addSpot.html.twig', array(
          'form' => $form->createView(),
        ));
    }
}
