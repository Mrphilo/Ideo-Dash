<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Apprenant
 *
 * @ORM\Table(name="apprenant")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\ApprenantRepository")
 */
class Apprenant
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
     * @ORM\Column(name="id_user", type="integer", nullable=true)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var bool
     *
     * @ORM\Column(name="valid", type="boolean", nullable=true)
     */
    private $valid;

    /**
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=true)
     */
    private $idClient;

    /**
     * @var int
     *
     * @ORM\Column(name="id_projet", type="integer", nullable=true)
     */
    private $idProjet;

    /**
     * @var string
     *
     * @ORM\Column(name="gsm", type="string", length=255, nullable=true)
     */
    private $gsm;


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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Apprenant
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Apprenant
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Apprenant
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Apprenant
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set valid
     *
     * @param boolean $valid
     *
     * @return Apprenant
     */
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get valid
     *
     * @return bool
     */
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set idClient
     *
     * @param integer $idClient
     *
     * @return Apprenant
     */
    public function setIdClient($idClient)
    {
        $this->idClient = $idClient;

        return $this;
    }

    /**
     * Get idClient
     *
     * @return int
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * Set idProjet
     *
     * @param integer $idProjet
     *
     * @return Apprenant
     */
    public function setIdProjet($idProjet)
    {
        $this->idProjet = $idProjet;

        return $this;
    }

    /**
     * Get idProjet
     *
     * @return int
     */
    public function getIdProjet()
    {
        return $this->idProjet;
    }

    /**
     * Set gsm
     *
     * @param string $gsm
     *
     * @return Apprenant
     */
    public function setGsm($gsm)
    {
        $this->gsm = $gsm;

        return $this;
    }

    /**
     * Get gsm
     *
     * @return string
     */
    public function getGsm()
    {
        return $this->gsm;
    }
}

