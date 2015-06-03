<?php

namespace dive\SpotBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use dive\SpotBundle\Entity\Spot;

class SpotMapXML
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if (!$entity instanceof Spot){
            return;
        }
        
        $dom = new \DOMDocument("1.0");
        $node = $dom->createElement("spots");
        $parnode = $dom->appendChild($node);
        header("Content-type: text/xml");
        
        $repository = $args->getEntityManager()->getRepository('diveSpotBundle:Spot');
        $listSpot = $repository->findAll();
        
        foreach ($listSpot as $spot) {
            $node = $dom->createElement("spot");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("name", $spot->getName());
            $newnode->setAttribute("lat", $spot->getLattitude());
            $newnode->setAttribute("lng", $spot->getLongitude());
            $newnode->setAttribute("maxDepth", $spot->getMaxDepth());
            $newnode->setAttribute("description", $spot->getDescription());
        }
        $dom->save("spotmap.xml");
    }
}