<?php
// src/AdManager/PublisherBundle/Entity/Ad.php
namespace AdManager\PublisherBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

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
}