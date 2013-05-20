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
		$field->setDeleted(0);
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

    public function deleteAction($id, $confirm = 0)
    {
	$field = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Field')
	    ->find($id);
	if ($field->getDeleted() == 1)
	{
	    return $this->redirect($this->generateUrl('ad_manager_field_homepage'));
	}
	    
	$request = $this->getRequest();
	
	if ($request->getMethod() == 'POST') {
	    $form = $request->request->get('form');
	    
	    if ($form['confirm'] == 1)
	    {
		$em = $this->getDoctrine()->getEntityManager();
		$field->setDeleted('1');
		$em->flush();
		return $this->redirect($this->generateUrl('ad_manager_field_homepage'));
	    }
	    
	} else {
	    $form = $this->createFormBuilder()
		->add('confirm', 'checkbox', array('label' => 'Do you realy want to delete field'))
		->getForm();
	}
	
	if (!$field) {
	    throw $this->createNotFoundException('No field found for id = '. $id);
	}
        return $this->render(
		'AdManagerPublisherBundle:Field:delete.html.twig', 
		array(
		    'field' => $field,
		    'form' =>  $form->createView(),
		    ));
    }
    
    public function editAction($id)
    {
	$field = $this->getDoctrine()
	    ->getRepository('AdManagerPublisherBundle:Field')
	    ->find($id);
	
	if (!$field) {
	    throw $this->createNotFoundException('No field found for id = '. $id);
	}
	
	$editForm = $this->createForm(new FieldType(), $field);
	$editForm->add('deleted', 'checkbox', array('label' => 'Is Deleted', 'required' => false,));
	$request = $this->getRequest();
	$em = $this->getDoctrine()->getEntityManager();
	
	if ($request->getMethod() == 'POST') {
	    $editForm->bindRequest($request);

	    if ($editForm->isValid()) {
		$field = $editForm->getData();
		$field->setDeleted(0);
		$em->persist($field);
		$em->flush();
		
		return $this->redirect($this->generateUrl('ad_manager_field_homepage'));
	    }
	}
	
        return $this->render(
		'AdManagerPublisherBundle:Field:edit.html.twig', 
		array(
		    'field' => $field,
		    'form' =>  $editForm->createView(),
		    ));
    }
    
}
