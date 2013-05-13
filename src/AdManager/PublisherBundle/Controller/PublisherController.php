<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdManager\PublisherBundle\Entity\Publisher;
use AdManager\PublisherBundle\Form\PublisherType;

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
	$publisher = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Publisher')
	    ->find($id);
	
	if (!$publisher) {
	    throw $this->createNotFoundException('No publisher found for id = '. $id);
	}
	
	
        return $this->render('AdManagerPublisherBundle:Publisher:show.html.twig', array('publisher' => $publisher));
    }
    
    
    public function addAction(Request $request)
    {
	$publisher = new Publisher();
	$form = $this->createForm(new PublisherType(), $publisher);
	
	if ($request->getMethod() == 'POST') {
	    $form->bindRequest($request);

	    if ($form->isValid()) {
		// выполняем прочие действие, например, сохраняем задачу в базе данных
		
		$publisher = $form->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($publisher);
		$em->flush();
		
		
		return $this->redirect($this->generateUrl('ad_manager_publisher_homepage'));
	    }
	}
	
	
	return $this->render('AdManagerPublisherBundle:Publisher:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
