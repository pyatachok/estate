<?php
// src/AdManager/PublisherBundle/Form/AdType.php
namespace AdManager\PublisherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use AdManager\PublisherBundle\Entity\Publisher;

class AdType extends AbstractType
{
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('creation_date', 'date', array(
	    'widget' => 'single_text',
	    'input'  => 'datetime',
	    'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
	    'required' => true, 
	    'format' => 'yyyy-MM-dd HH:mm:ss',
	    'data' => new \DateTime("now")
	    ));
	$builder->add('publisher', 'entity', array(
	    'class' => 'AdManagerPublisherBundle:Publisher',
	    'property' => 'name',
	));
//        $builder->add('publisher_id', 'text', array(
//	    'required' => true, 
//	    'empty_data' => FALSE,
//	    'max_length' => 255,
//	    ));
    }
    
    public function getName()
    {
	return 'ad';
    }
    
    public function getDefaultOptions(array $options)
    {
	return array(
	    'data_class' => 'AdManager\PublisherBundle\Entity\Ad',
	);
    }

    
    
}