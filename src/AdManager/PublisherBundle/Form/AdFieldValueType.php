<?php
// src/AdManager/PublisherBundle/Form/AdFieldValueType.php
namespace AdManager\PublisherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

use AdManager\PublisherBundle\Entity\Ad;
use AdManager\PublisherBundle\Entity\Field;

class AdFieldValueType extends AbstractType
{
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('value', 'textarea', array(
	    'required' => true, 
	    'empty_data' => FALSE,
	    'max_length' => 2048,
	    ));
	
	$builder->add('field', 'entity', array(
	    'class' => 'AdManagerPublisherBundle:Field',
	    'property' => 'name',
	));

    }
    
    public function getName()
    {
	return 'ad_field_value';
    }
    
    public function getDefaultOptions(array $options)
    {
	return array(
	    'data_class' => 'AdManager\PublisherBundle\Entity\AdFieldValue',
	);
    }

    
    
}