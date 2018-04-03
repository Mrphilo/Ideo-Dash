<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistique
 *
 * @ORM\Table(name="statistique")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\StatistiqueRepository")
 */
class Statistique
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="total_users", type="integer")
     */
    private $totalUsers;

    /**
     * @var int
     *
     * @ORM\Column(name="course_enrollments", type="integer")
     */
    private $courseEnrollments;

    /**
     * @var int
     *
     * @ORM\Column(name="course_enrollments_not_started", type="integer")
     */
    private $courseEnrollmentsNotStarted;

    /**
     * @var int
     *
     * @ORM\Column(name="course_enrollments_in_progress", type="integer")
     */
    private $courseEnrollmentsInProgress;

    /**
     * @var int
     *
     * @ORM\Column(name="course_enrollments_completed", type="integer")
     */
    private $courseEnrollmentsCompleted;

    /**
     * @var int
     *
     * @ORM\Column(name="course_enrollments_expired", type="integer")
     */
    private $courseEnrollmentsExpired;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set totalUsers
     *
     * @param integer $totalUsers
     *
     * @return Statistique
     */
    public function setTotalUsers($totalUsers)
    {
        $this->totalUsers = $totalUsers;

        return $this;
    }

    /**
     * Get totalUsers
     *
     * @return int
     */
    public function getTotalUsers()
    {
        return $this->totalUsers;
    }

    /**
     * Set courseEnrollments
     *
     * @param integer $courseEnrollments
     *
     * @return Statistique
     */
    public function setCourseEnrollments($courseEnrollments)
    {
        $this->courseEnrollments = $courseEnrollments;

        return $this;
    }

    /**
     * Get courseEnrollments
     *
     * @return int
     */
    public function getCourseEnrollments()
    {
        return $this->courseEnrollments;
    }

    /**
     * Set courseEnrollmentsNotStarted
     *
     * @param integer $courseEnrollmentsNotStarted
     *
     * @return Statistique
     */
    public function setCourseEnrollmentsNotStarted($courseEnrollmentsNotStarted)
    {
        $this->courseEnrollmentsNotStarted = $courseEnrollmentsNotStarted;

        return $this;
    }

    /**
     * Get courseEnrollmentsNotStarted
     *
     * @return int
     */
    public function getCourseEnrollmentsNotStarted()
    {
        return $this->courseEnrollmentsNotStarted;
    }

    /**
     * Set courseEnrollmentsInProgress
     *
     * @param integer $courseEnrollmentsInProgress
     *
     * @return Statistique
     */
    public function setCourseEnrollmentsInProgress($courseEnrollmentsInProgress)
    {
        $this->courseEnrollmentsInProgress = $courseEnrollmentsInProgress;

        return $this;
    }

    /**
     * Get courseEnrollmentsInProgress
     *
     * @return int
     */
    public function getCourseEnrollmentsInProgress()
    {
        return $this->courseEnrollmentsInProgress;
    }

    /**
     * Set courseEnrollmentsCompleted
     *
     * @param integer $courseEnrollmentsCompleted
     *
     * @return Statistique
     */
    public function setCourseEnrollmentsCompleted($courseEnrollmentsCompleted)
    {
        $this->courseEnrollmentsCompleted = $courseEnrollmentsCompleted;

        return $this;
    }

    /**
     * Get courseEnrollmentsCompleted
     *
     * @return int
     */
    public function getCourseEnrollmentsCompleted()
    {
        return $this->courseEnrollmentsCompleted;
    }

    /**
     * Set courseEnrollmentsExpired
     *
     * @param integer $courseEnrollmentsExpired
     *
     * @return Statistique
     */
    public function setCourseEnrollmentsExpired($courseEnrollmentsExpired)
    {
        $this->courseEnrollmentsExpired = $courseEnrollmentsExpired;

        return $this;
    }

    /**
     * Get courseEnrollmentsExpired
     *
     * @return int
     */
    public function getCourseEnrollmentsExpired()
    {
        return $this->courseEnrollmentsExpired;
    }
}

