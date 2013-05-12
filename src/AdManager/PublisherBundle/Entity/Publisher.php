<?php
// src/AdManager/PublisherBundle/Entity/Publisher.php
namespace AdManager\PublisherBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="publisher")
 */
class Publisher
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
     * @ORM\OneToMany(targetEntity="Ad", mappedBy="publisher")
     */
    protected $ads;
    
    public function __construct()
    {
        $this->ads = new ArrayCollection();
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

    /**
     * Add ads
     *
     * @param \AdManager\PublisherBundle\Entity\Ad $ads
     * @return Publisher
     */
    public function addAd(\AdManager\PublisherBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;
    
        return $this;
    }

    /**
     * Remove ads
     *
     * @param \AdManager\PublisherBundle\Entity\Ad $ads
     */
    public function removeAd(\AdManager\PublisherBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAds()
    {
        return $this->ads;
    }
}