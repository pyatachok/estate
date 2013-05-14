<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AdManager\PublisherBundle\Entity\Field;
use AdManager\PublisherBundle\Form\FieldType;

class FieldController extends Controller
{
    public function indexAction()
    {
	$fields = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Field')
	    ->findAll();
	
	if (!$fields) {
	    throw $this->createNotFoundException('No fields found');
	}

        return $this->render('AdManagerPublisherBundle:Field:index.html.twig', array('fields' => $fields));
    }
    
    public function showAction($id)
    {
	$field = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Field')
	    ->find($id);
	
	if (!$field) {
	    throw $this->createNotFoundException('No fields found for id = '. $id);
	}
	
	
        return $this->render('AdManagerPublisherBundle:Field:show.html.twig', array('field' => $field));
    }
    
    
    public function addAction(Request $request)
    {
	$field = new Field();
	$form = $this->createForm(new FieldType(), $field);
	
	if ($request->getMethod() == 'POST') {
	    $form->bindRequest($request);

	    if ($form->isValid()) {
		// выполняем прочие действие, например, сохраняем задачу в базе данных
		
		$field = $form->getData();
		$em = $this->getDoctrine()->getEntityManager();
		$em->persist($field);
		$em->flush();
		
		return $this->redirect($this->generateUrl('ad_manager_field_homepage'));
	    }
	}
	
	return $this->render('AdManagerPublisherBundle:Field:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
}
