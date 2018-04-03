<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contrat
 *
 * @ORM\Table(name="contrat")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\ContratRepository")
 */
class Contrat
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
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_contrat", type="date")
     */
    private $dateContrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_debut_contrat", type="date")
     */
    private $dateDebutContrat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_fin_contrat", type="date")
     */
    private $dateFinContrat;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Contrat
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set dateContrat
     *
     * @param \DateTime $dateContrat
     *
     * @return Contrat
     */
    public function setDateContrat($dateContrat)
    {
        $this->dateContrat = $dateContrat;

        return $this;
    }

    /**
     * Get dateContrat
     *
     * @return \DateTime
     */
    public function getDateContrat()
    {
        return $this->dateContrat;
    }

    /**
     * Set dateDebutContrat
     *
     * @param \DateTime $dateDebutContrat
     *
     * @return Contrat
     */
    public function setDateDebutContrat($dateDebutContrat)
    {
        $this->dateDebutContrat = $dateDebutContrat;

        return $this;
    }

    /**
     * Get dateDebutContrat
     *
     * @return \DateTime
     */
    public function getDateDebutContrat()
    {
        return $this->dateDebutContrat;
    }

    /**
     * Set dateFinContrat
     *
     * @param \DateTime $dateFinContrat
     *
     * @return Contrat
     */
    public function setDateFinContrat($dateFinContrat)
    {
        $this->dateFinContrat = $dateFinContrat;

        return $this;
    }

    /**
     * Get dateFinContrat
     *
     * @return \DateTime
     */
    public function getDateFinContrat()
    {
        return $this->dateFinContrat;
    }
}

