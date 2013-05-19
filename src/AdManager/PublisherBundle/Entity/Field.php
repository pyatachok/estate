<?php
// src/AdManager/PublisherBundle/Entity/Field.php
namespace AdManager\PublisherBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;

use AdManager\PublisherBundle\Entity\Field;
use AdManager\PublisherBundle\Entity\AdFieldValue;
/**
 * @ORM\Entity
 * @ORM\Table(name="field")
 */
class Field
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @var type 
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     * @var type 
     */
    protected $deleted;
    
    /**
     * @ORM\ManyToMany(targetEntity="Field", mappedBy="relatedFields")
     **/
    private $parentFields;

    /**
     * @ORM\ManyToMany(targetEntity="Field", inversedBy="parentFields")
     * @ORM\JoinTable(name="related_fields",
     *      joinColumns={@ORM\JoinColumn(name="field_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="related_field_id", referencedColumnName="id")}
     *      )
     **/
    private $relatedFields;
    
    /**
     * @ORM\OneToMany(targetEntity="AdFieldValue", mappedBy="field")
     */
    protected $values;
    
    public function __construct() {
        $this->values = new ArrayCollection();
        $this->parentFields = new ArrayCollection();
        $this->relatedFields = new ArrayCollection();
    }

    /**
     * Get parent fields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getParentFields()
    {
        return $this->parentFields;
    }
    
    /**
     * Get relatedFields
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelatedFields()
    {
        return $this->relatedFields;
    }
    
    
    
    
    
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
     * Set name
     *
     * @param string $name
     * @return Publisher
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());

    }

    /**
     * Add parentFields
     *
     * @param \AdManager\PublisherBundle\Entity\Field $parentFields
     * @return Field
     */
    public function addParentField(\AdManager\PublisherBundle\Entity\Field $parentFields)
    {
        $this->parentFields[] = $parentFields;
    
        return $this;
    }

    /**
     * Remove parentFields
     *
     * @param \AdManager\PublisherBundle\Entity\Field $parentFields
     */
    public function removeParentField(\AdManager\PublisherBundle\Entity\Field $parentFields)
    {
        $this->parentFields->removeElement($parentFields);
    }

    /**
     * Add relatedFields
     *
     * @param \AdManager\PublisherBundle\Entity\Field $relatedFields
     * @return Field
     */
    public function addRelatedField(\AdManager\PublisherBundle\Entity\Field $relatedFields)
    {
        $this->relatedFields[] = $relatedFields;
    
        return $this;
    }

    /**
     * Remove relatedFields
     *
     * @param \AdManager\PublisherBundle\Entity\Field $relatedFields
     */
    public function removeRelatedField(\AdManager\PublisherBundle\Entity\Field $relatedFields)
    {
        $this->relatedFields->removeElement($relatedFields);
    }

    /**
     * Add values
     *
     * @param \AdManager\PublisherBundle\Entity\AdFieldValue $values
     * @return Field
     */
    public function addValue(\AdManager\PublisherBundle\Entity\AdFieldValue $values)
    {
        $this->values[] = $values;

        return $this;
    }

    /**
     * Remove values
     *
     * @param \AdManager\PublisherBundle\Entity\AdFieldValue $values
     */
    public function removeValue(\AdManager\PublisherBundle\Entity\AdFieldValue $values)
    {
        $this->values->removeElement($values);
    }

    /**
     * Get values
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * Set deleted
     *
     * @param integer $deleted
     * @return Field
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return integer 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }
}
