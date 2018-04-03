<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\ClientRepository")
 */
class Client
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
     * @ORM\Column(name="id_org", type="integer", nullable=true)
     */
    private $idOrg;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var int
     *
     * @ORM\Column(name="course_category_id", type="integer", nullable=true)
     */
    private $courseCategoryId;

    /**
     * @var int
     *
     * @ORM\Column(name="id_stat", type="integer", nullable=true)
     */
    private $idStat;

    /**
     * @var int
     *
     * @ORM\Column(name="id_contrat", type="integer", nullable=true)
     */
    private $idContrat;

    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=true)
     */
    private $idService;


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
     * Set idOrg
     *
     * @param integer $idOrg
     *
     * @return Client
     */
    public function setIdOrg($idOrg)
    {
        $this->idOrg = $idOrg;

        return $this;
    }

    /**
     * Get idOrg
     *
     * @return int
     */
    public function getIdOrg()
    {
        return $this->idOrg;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Client
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Client
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Client
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set courseCategoryId
     *
     * @param integer $courseCategoryId
     *
     * @return Client
     */
    public function setCourseCategoryId($courseCategoryId)
    {
        $this->courseCategoryId = $courseCategoryId;

        return $this;
    }

    /**
     * Get courseCategoryId
     *
     * @return int
     */
    public function getCourseCategoryId()
    {
        return $this->courseCategoryId;
    }

    /**
     * Set idStat
     *
     * @param integer $idStat
     *
     * @return Client
     */
    public function setIdStat($idStat)
    {
        $this->idStat = $idStat;

        return $this;
    }

    /**
     * Get idStat
     *
     * @return int
     */
    public function getIdStat()
    {
        return $this->idStat;
    }

    /**
     * Set idContrat
     *
     * @param integer $idContrat
     *
     * @return Client
     */
    public function setIdContrat($idContrat)
    {
        $this->idContrat = $idContrat;

        return $this;
    }

    /**
     * Get idContrat
     *
     * @return int
     */
    public function getIdContrat()
    {
        return $this->idContrat;
    }

    /**
     * Set idService
     *
     * @param integer $idService
     *
     * @return Client
     */
    public function setIdService($idService)
    {
        $this->idService = $idService;

        return $this;
    }

    /**
     * Get idService
     *
     * @return int
     */
    public function getIdService()
    {
        return $this->idService;
    }
}

