<?php

namespace Ideo\DashBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="Ideo\DashBundle\Repository\ServiceRepository")
 */
class Service
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
     * @var bool
     *
     * @ORM\Column(name="soft_skills", type="boolean")
     */
    private $softSkills;

    /**
     * @var bool
     *
     * @ORM\Column(name="sur_mesure", type="boolean")
     */
    private $surMesure;

    /**
     * @var bool
     *
     * @ORM\Column(name="langue", type="boolean")
     */
    private $langue;

    /**
     * @var bool
     *
     * @ORM\Column(name="bureautique", type="boolean")
     */
    private $bureautique;


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
     * @return Service
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
     * Set softSkills
     *
     * @param boolean $softSkills
     *
     * @return Service
     */
    public function setSoftSkills($softSkills)
    {
        $this->softSkills = $softSkills;

        return $this;
    }

    /**
     * Get softSkills
     *
     * @return bool
     */
    public function getSoftSkills()
    {
        return $this->softSkills;
    }

    /**
     * Set surMesure
     *
     * @param boolean $surMesure
     *
     * @return Service
     */
    public function setSurMesure($surMesure)
    {
        $this->surMesure = $surMesure;

        return $this;
    }

    /**
     * Get surMesure
     *
     * @return bool
     */
    public function getSurMesure()
    {
        return $this->surMesure;
    }

    /**
     * Set langue
     *
     * @param boolean $langue
     *
     * @return Service
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return bool
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set bureautique
     *
     * @param boolean $bureautique
     *
     * @return Service
     */
    public function setBureautique($bureautique)
    {
        $this->bureautique = $bureautique;

        return $this;
    }

    /**
     * Get bureautique
     *
     * @return bool
     */
    public function getBureautique()
    {
        return $this->bureautique;
    }
}

