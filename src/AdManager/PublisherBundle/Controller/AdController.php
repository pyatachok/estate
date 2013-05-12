<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdController extends Controller
{
    public function indexAction()
    {
	$ads = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Ad')
	    ->findAll();
	
	if (!$ads) {
	    throw $this->createNotFoundException('No ads found');
	}

	return $this->render('AdManagerPublisherBundle:Ad:index.html.twig', array('ads' => $ads));
    }
    
    public function showAction($id)
    {
	$ad = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Ad')
	    ->find($id);
	
	if (!$ad) {
	    throw $this->createNotFoundException('No ad found for id = '. $id);
	}
	
	
        return $this->render('AdManagerPublisherBundle:Ad:show.html.twig', array('ad' => $ad));
    }
    
    
    public function createAction()
    {
	
    }
    
}
