<?php

namespace dive\SpotBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use dive\SpotBundle\Entity\Spot;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function viewAction($id)
    {
        // Récupérer objet spot pour envoyer à la vue
        return $this->render('diveSpotBundle:Default:view.html.twig', array('spot' => $spot));
    }
    
    public function addAction(Request $request)
    {
        $spot = new Spot();

        $formBuilder = $this->get('form.factory')->createBuilder('form', $spot);

        $formBuilder
          ->add('name',        'text')
          ->add('country',     'country')
          ->add('lattitude',   'number')
          ->add('longitude',   'number')
          ->add('maxDepth',    'integer')
          ->add('description', 'textarea')
          ->add('save',        'submit')
        ;

        $form = $formBuilder->getForm();
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spot);
            $em->flush();
            
            $request->getSession()->getFlashBag()->add('notice', 'Spot successfully added.');
            return $this->redirect($this->generateUrl('dive_spot_view', array('id' => $spot->getId())));
        }

        return $this->render('diveSpotBundle:Default:addSpot.html.twig', array(
          'form' => $form->createView(),
        ));
    }
}
