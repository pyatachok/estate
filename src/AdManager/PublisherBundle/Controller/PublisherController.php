<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublisherController extends Controller
{
    public function indexAction()
    {
	$publishers = array(1 => 'First Publisher', 2 => 'Second Publisher');
        return $this->render('AdManagerPublisherBundle:Publisher:index.html.twig', array('publishers' => $publishers));
    }
    
    public function showAction($id)
    {
        return $this->render('AdManagerPublisherBundle:Publisher:show.html.twig', array('id' => $id));
    }
    
    
}
