<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublisherController extends Controller
{
    public function indexAction()
    {
	$publishers = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Publisher')
	    ->findAll();
	
	if (!$publishers) {
	    throw $this->createNotFoundException('No publishers found');
	}

        return $this->render('AdManagerPublisherBundle:Publisher:index.html.twig', array('publishers' => $publishers));
    }
    
    public function showAction($id)
    {
        return $this->render('AdManagerPublisherBundle:Publisher:show.html.twig', array('id' => $id));
    }
    
    
}
