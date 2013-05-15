<?php
// src/AdManager/PublisherBundle/Form/FieldType.php
namespace AdManager\PublisherBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;


class FieldType extends AbstractType
{
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', array(
	    'required' => true, 
	    'empty_data' => FALSE,
	    'max_length' => 255,
	    ));
	
//	$builder->add('users', 'entity', array(
//	    'class' => 'AdaptiveUserBundle:User',
//	    'expanded' => true,
//	    'multiple' => true,
//	    'query_builder' => function(EntityRepository $er) {
//		return $er->createQueryBuilder('u')
//		    ->orderBy('u.username', 'ASC');
//	    },
//	));
	
    $builder->add('related_fields', 'entity', array(
	'class' => 'AdManagerPublisherBundle:Field',
	'property' => 'name',
	'multiple' => true,
    ));

	    
	    
    }
    
    public function getName()
    {
	return 'field';
    }
    
    public function getDefaultOptions(array $options)
    {
	return array(
	    'data_class' => 'AdManager\PublisherBundle\Entity\Field',
	);
    }

    
    
}