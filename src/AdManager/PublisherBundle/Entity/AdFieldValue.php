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

    /**
     * Set id
     *
     * @param integer $id
     * @return AdFieldValue
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return AdFieldValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set field_id
     *
     * @param integer $fieldId
     * @return AdFieldValue
     */
    public function setFieldId($fieldId)
    {
        $this->field_id = $fieldId;

        return $this;
    }

    /**
     * Get field_id
     *
     * @return integer 
     */
    public function getFieldId()
    {
        return $this->field_id;
    }

    /**
     * Set ad_id
     *
     * @param integer $adId
     * @return AdFieldValue
     */
    public function setAdId($adId)
    {
        $this->ad_id = $adId;

        return $this;
    }

    /**
     * Get ad_id
     *
     * @return integer 
     */
    public function getAdId()
    {
        return $this->ad_id;
    }

    /**
     * Set field
     *
     * @param \AdManager\PublisherBundle\Entity\Field $field
     * @return AdFieldValue
     */
    public function setField(\AdManager\PublisherBundle\Entity\Field $field = null)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return \AdManager\PublisherBundle\Entity\Field 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set ad
     *
     * @param \AdManager\PublisherBundle\Entity\Ad $ad
     * @return AdFieldValue
     */
    public function setAd(\AdManager\PublisherBundle\Entity\Ad $ad = null)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \AdManager\PublisherBundle\Entity\Ad 
     */
    public function getAd()
    {
        return $this->ad;
    }
}
