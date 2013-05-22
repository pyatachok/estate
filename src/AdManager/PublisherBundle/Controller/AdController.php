<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdManager\PublisherBundle\Entity\Ad;
use AdManager\PublisherBundle\Entity\Publisher;
use AdManager\PublisherBundle\Form\AdType;
use AdManager\PublisherBundle\Form\AdFieldValueType;
class AdController extends Controller
{
    public function indexAction()
    {
	$ads = $this->getDoctrine()
		->getRepository('AdManagerPublisherBundle:Ad')
		->findBy(array(), array('creation_date' => 'DESC'))
		;
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
		$ad->setDeleted(0);

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
    
    public function deleteAction($id, $confirm = 0)
    {
	$ad = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Ad')
	    ->find($id);
	if ($ad->getDeleted() == 1)
	{
	    return $this->redirect($this->generateUrl('ad_manager_ad_homepage'));
	}
	    
	$request = $this->getRequest();
	
	if ($request->getMethod() == 'POST') {
	    $form = $request->request->get('form');
	    
	    if ($form['confirm'] == 1)
	    {
		$em = $this->getDoctrine()->getEntityManager();
		$ad->setDeleted('1');
		$em->flush();
		return $this->redirect($this->generateUrl('ad_manager_ad_homepage'));
	    }
	    
	} else {
	    $form = $this->createFormBuilder()
		->add('confirm', 'checkbox', array('label' => 'Do you realy want to delete advertisment'))
		->getForm();
	}
	
	if (!$ad) {
	    throw $this->createNotFoundException('No ad found for id = '. $id);
	}
        return $this->render(
		'AdManagerPublisherBundle:Ad:delete.html.twig', 
		array(
		    'ad' => $ad,
		    'form' =>  $form->createView(),
		    ));
    }
    
    public function editAction($id)
    {
	$ad = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Ad')
	    ->find($id);
	
	if (!$ad) {
	    throw $this->createNotFoundException('No advertisment found for id = '. $id);
	}

	{
	    /**
	     * Составим массив полей объявления до внесения изменений
	     */

	    $beforUpdateFields = array();
	    foreach ($ad->getFieldValues() as $fieldValue)
	    {
		$beforUpdateFields[$fieldValue->getId()] = $fieldValue;
	    }
	}
	
	$editForm = $this->createForm(new AdType(), $ad);
	$editForm->add('deleted', 'checkbox', array(
	    'label' => 'Is Deleted', 
	    'required' => false,
	    ));	
	$request = $this->getRequest();
	$em = $this->getDoctrine()->getEntityManager();
	
	if ($request->getMethod() == 'POST') {
	    $editForm->bindRequest($request);

	    if ($editForm->isValid()) {
		$ad = $editForm->getData();
		
		$notDeletedIds = array_unique($this->getElementsByarrayIndex($_REQUEST['ad']['field_values'], 'id'));

		foreach($beforUpdateFields as $key => $value)
		{
		    if (!in_array($key, $notDeletedIds))
		    {
			$em->remove($value);
		    }
		}
		$ad->setDeleted(0);
		$em->persist($ad);
		$em->flush();
		
		return $this->redirect($this->generateUrl('ad_manager_ad_homepage'));
	    }
	}
	
        return $this->render(
		'AdManagerPublisherBundle:Ad:edit.html.twig', 
		array(
		    'ad' => $ad,
		    'form' =>  $editForm->createView(),
		    ));
    }
    
    
    private function getElementsByarrayIndex($array, $whatToFind) 
    {
	$return = array();
	foreach ($array as $value)
	{
	    if (!empty($value[$whatToFind]))
	    {
		$return[] = $value[$whatToFind];
	    }
	}
	return $return;
	
    }
    
}
