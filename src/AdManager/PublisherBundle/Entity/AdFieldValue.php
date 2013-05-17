<?php
// src/AdManager/PublisherBundle/Entity/Field.php
namespace AdManager\PublisherBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

use AdManager\PublisherBundle\Entity\Field;
use AdManager\PublisherBundle\Entity\Ad;

/**
 * @ORM\Entity
 * @ORM\Table(name="ad_field_value")
 */
class AdFieldValue
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=2048)
     * @var type 
     */
    protected $value;

    /**
     * @ORM\Column(type="integer")
     * @var type 
     */
    protected $field_id;

    /**
     * @ORM\ManyToOne(targetEntity="Field", inversedBy="values")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     */
    protected $field;
    
    /**
     * @ORM\Column(type="integer")
     * @var type 
     */
    protected $ad_id;

    /**
     * @ORM\ManyToOne(targetEntity="Ad", inversedBy="field_values")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id")
     */
    protected $ad;
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

}