<?php
// src/AdManager/PublisherBundle/Entity/Ad.php
namespace AdManager\PublisherBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

/**
 * @ORM\Entity
 * @ORM\Table(name="ad")
 */
class Ad
{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="datetime")
     * @var type 
     */
    protected $creation_date;
    
    /**
     * @ORM\Column(type="integer")
     * @var type 
     */
    protected $publisher_id;

    /**
     * @ORM\ManyToOne(targetEntity="Publisher", inversedBy="ads")
     * @ORM\JoinColumn(name="publisher_id", referencedColumnName="id")
     */
    protected $publisher;

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
     * Set creation_date
     *
     * @param \DateTime $creationDate
     * @return Ad
     */
    public function setCreationDate($creationDate)
    {
        $this->creation_date = $creationDate;
    
        return $this;
    }

    /**
     * Get creation_date
     *
     * @return \DateTime 
     */
    public function getCreationDate()
    {
        return $this->creation_date;
    }

    /**
     * Set publisher_id
     *
     * @param integer $publisherId
     * @return Ad
     */
    public function setPublisherId($publisherId)
    {
        $this->publisher_id = $publisherId;
    
        return $this;
    }

    /**
     * Get publisher_id
     *
     * @return integer 
     */
    public function getPublisherId()
    {
        return $this->publisher_id;
    }

    /**
     * Set publisher
     *
     * @param \AdManager\PublisherBundle\Entity\Publisher $publisher
     * @return Ad
     */
    public function setPublisher(\AdManager\PublisherBundle\Entity\Publisher $publisher = null)
    {
        $this->publisher = $publisher;
    
        return $this;
    }

    /**
     * Get publisher
     *
     * @return \AdManager\PublisherBundle\Entity\Publisher 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
    
    
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('publisher', new NotBlank());

        $metadata->addPropertyConstraint('creation_date', new NotBlank());
        $metadata->addPropertyConstraint('creation_date', new Type('\DateTime'));
    }
}