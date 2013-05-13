<?php
// src/AdManager/PublisherBundle/Form/PublisherType.php
namespace AdManager\PublisherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;

class PublisherType extends AbstractType
{
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
	    'required' => true, 
	    'empty_data' => FALSE,
	    'max_length' => 255,
	    ));
    }
    
    public function getName()
    {
	return 'publisher';
    }
    
    public function getDefaultOptions(array $options)
    {
	return array(
	    'data_class' => 'AdManager\PublisherBundle\Entity\Publisher',
	);
    }

    
    
}