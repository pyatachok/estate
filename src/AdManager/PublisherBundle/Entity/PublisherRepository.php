<?php

namespace AdManager\PublisherBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PublisherRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PublisherRepository extends EntityRepository
{
    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery('SELECT p FROM AdManagerPublisherBundle:Publisher p ORDER BY p.name ASC')
            ->getResult();
    }
    
    public function markAsDeleted()
    {
	echo '<pre>';
	var_export($this->getId());
	echo '</pre>';





//        return $this->getEntityManager()
//            ->createQuery('UPDATE p FROM AdManagerPublisherBundle:Publisher p SET()')
//            ->getResult();
    }
    
    
}
