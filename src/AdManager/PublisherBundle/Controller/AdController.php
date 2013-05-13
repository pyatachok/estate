<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdManager\PublisherBundle\Entity\Ad;
use AdManager\PublisherBundle\Entity\Publisher;
use AdManager\PublisherBundle\Form\AdType;
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
    
    
    public function addAction(Request $request)
    {
	$ad = new Ad();
	$form = $this->createForm(new AdType(), $ad);
	
	if ($request->getMethod() == 'POST') {
	    $form->bindRequest($request);

	    if ($form->isValid()) {
		// выполняем прочие действие, например, сохраняем задачу в базе данных
		
		$ad = $form->getData();
//		$publisher = $this->getDoctrine()
//		    ->getRepository('AdManagerPublisherBundle:Publisher')
//		    ->find($ad->getPublisherId());
//		$ad->setPublisher($publisher);
		
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($ad);
		$em->flush();
		
		return $this->redirect($this->generateUrl('ad_manager_ad_homepage'));
	    }
	}
	
	
	return $this->render('AdManagerPublisherBundle:Ad:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
