<?php

namespace Ideo\DashBundle\Repository;

/**
 * ServiceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ServiceRepository extends \Doctrine\ORM\EntityRepository
{
    public function findServiceById($id)
    {
        $requete = $this->getEntityManager()->createQuery('SELECT s FROM AppBundle:service s WHERE s.id = ?1');
        $requete->setParameter(1,$id);
        return $requete->getResult();
    }
}
