<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projet
 *
 * @ORM\Table(name="projet")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\ProjetRepository")
 */
class Projet
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
     * @ORM\Column(name="id_projet", type="integer", nullable=true)
     */
    private $idProjet;

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
     * @var \DateTime
     *
     * @ORM\Column(name="date_lancement", type="date", nullable=true)
     */
    private $dateLancement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin", type="date", nullable=true)
     */
    private $dateFin;

    /**
     * @var int
     *
     * @ORM\Column(name="effectif_prevu", type="integer", nullable=true)
     */
    private $effectifPrevu;

    /**
     * @var int
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

    /**
     * @var int
     *
     * @ORM\Column(name="id_stat", type="integer", nullable=true)
     */
    private $idStat;


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
     * Set idProjet
     *
     * @param integer $idProjet
     *
     * @return Projet
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
     * Set code
     *
     * @param string $code
     *
     * @return Projet
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
     * @return Projet
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
     * Set dateLancement
     *
     * @param \DateTime $dateLancement
     *
     * @return Projet
     */
    public function setDateLancement($dateLancement)
    {
        $this->dateLancement = $dateLancement;

        return $this;
    }

    /**
     * Get dateLancement
     *
     * @return \DateTime
     */
    public function getDateLancement()
    {
        return $this->dateLancement;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Projet
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set effectifPrevu
     *
     * @param integer $effectifPrevu
     *
     * @return Projet
     */
    public function setEffectifPrevu($effectifPrevu)
    {
        $this->effectifPrevu = $effectifPrevu;

        return $this;
    }

    /**
     * Get effectifPrevu
     *
     * @return int
     */
    public function getEffectifPrevu()
    {
        return $this->effectifPrevu;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     *
     * @return Projet
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set idStat
     *
     * @param integer $idStat
     *
     * @return Projet
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
}

