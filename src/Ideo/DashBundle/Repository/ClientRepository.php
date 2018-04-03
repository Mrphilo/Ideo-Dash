<?php

namespace Ideo\DashBundle\Repository;



/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{

    public function findClientInfoAndStats()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c.id, c.code, c.nom, c.status, s.totalUsers, s.courseEnrollments,
                      s.courseEnrollmentsNotStarted, s.courseEnrollmentsInProgress,
                       s.courseEnrollmentsCompleted, s.courseEnrollmentsExpired
                        FROM IdeoDashBundle:client c, IdeoDashBundle:Statistique s WHERE c.idStat = s.id'
            )
            ->getResult();
    }

    public function findIdStatById($org)
    {
        $requete = $this->getEntityManager()
            ->createQuery('SELECT c.idStat FROM IdeoDashBundle:client c WHERE c.idOrg = ?1') ;

        $requete->setParameter(1,$org);

        return $requete->getResult();
    }

    public function updateClientStats($id_stat,$tu,$ce,$cens,$ceip,$cec,$cee)
    {
        $requete = $this->getEntityManager()
            ->createQuery('UPDATE IdeoDashBundle:Statistique s SET s.totalUsers = :tu, s.courseEnrollments = :ce,
            s.courseEnrollmentsNotStarted = :cens, s.courseEnrollmentsInProgress = :ceip, 
            s.courseEnrollmentsCompleted = :cec, s.courseEnrollmentsExpired = :cee WHERE s.id = :idStat');

        $requete->setParameters(array(
            'tu' => $tu,
            'ce' => $ce,
            'cens' => $cens,
            'ceip' => $ceip,
            'cec' => $cec,
            'cee' => $cee,
            'idStat' => $id_stat,
        ));
        return $requete->getResult();
    }

    public function findClientInfoAndStatsById($id)
    {
        $requete = $this->getEntityManager()
            ->createQuery(
                'SELECT c.id, c.code, c.nom, c.status, s.totalUsers, s.courseEnrollments,
                      s.courseEnrollmentsNotStarted, s.courseEnrollmentsInProgress,
                       s.courseEnrollmentsCompleted, s.courseEnrollmentsExpired
                        FROM IdeoDashBundle:client c, IdeoDashBundle:Statistique s WHERE c.idStat = s.id and c.id = ?1'
            );

        $requete->setParameter(1 , $id);

        return $requete->getResult();
    }
}
