<?php
// src/Entity/User.php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80)
     * @Assert\NotBlank(message="Escribe tu nombre.")
     */
    protected $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="paterno", type="string", length=80)
     * @Assert\NotBlank(message="Escribe tu apellido paterno")
     */
    protected $paterno;

    /**
     * @var string
     *
     * @ORM\Column(name="materno", type="string", length=80)
     * @Assert\NotBlank(message="Escribe tu apellido materno")
     */
    protected $materno;

    /**
     * @var string
     *
     * @ORM\Column(name="plantel", type="string", length=255)
     * @Assert\NotBlank(message="Escribe el plantel al que perteneces")
     */
    protected $plantel;

    /**
     * @ORM\OneToMany(targetEntity="Estudiante", mappedBy="coordinador", cascade={"persist"})
     */
    private $estudiantes;


    public function __construct() {
        $this->estudiantes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=10)
     * @Assert\NotBlank(message="Celular a 10 dígitos")
     *
     * )
     */
    protected $celular;

    /**
     * @Gedmo\Slug(fields={"nombre", "paterno", "materno"}, updatable=false)
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * @var date
     *
     * @ORM\Column(name="createdAt", type="date")
     */
    protected $createdAt;

    /**
     * @var date
     *
     * @ORM\Column(name="modifiedAt", type="date")
     *      * @ORM\Column(type="datetime", nullable=true)

     */
    protected $modifiedAt;


    /**
     * Set estudiante
     *
     * @param string $estudiante
     * @return User
     */
    public function setEstudiante($estudiante)
    {
        $this->estudiante = $estudiante;

        return $this;
    }

    /**
     * Get estudiante
     *
     * @return string
     */
    public function getEstudiante()
    {
        return $this->estudiante;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getPaterno()
    {
        return $this->paterno;
    }

    /**
     * @param string $paterno
     */
    public function setPaterno(string $paterno)
    {
        $this->paterno = $paterno;
    }

    /**
     * @return string
     */
    public function getMaterno()
    {
        return $this->materno;
    }

    /**
     * @param string $materno
     */
    public function setMaterno(string $materno)
    {
        $this->materno = $materno;
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sede;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $municipio;

    /**
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param string $celular
     */
    public function setCelular(string $celular)
    {
        $this->celular = $celular;
    }


    /**
     * Set slug
     *
     * @param string $slug
     * @return User
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     * @return User
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
        $this->modifiedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * @param mixed $sede
     */
    public function setSede($sede)
    {
        $this->sede = $sede;
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }

    /**
     * Add estudiantes
     *
     * @param \App\Entity\Estudiante $estudiantes
     * @return User
     */
    public function addEstudiante(\App\Entity\Estudiante $estudiantes)
    {
        $this->estudiantes[] = $estudiantes;

        return $this;
    }

    /**
     * Remove estudiantes
     *
     * @param \App\Entity\Estudiante $estudiantes
     */
    public function removeEstudiante(\App\Entity\Estudiante $estudiantes)
    {
        $this->estudiantes->removeElement($estudiantes);
    }

    /**
     * Get estudiantes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEstudiantes()
    {
        return $this->estudiantes;
    }

    /**
     * @return string
     */
    public function getPlantel()
    {
        return $this->plantel;
    }

    /**
     * @param string $plantel
     */
    public function setPlantel(string $plantel)
    {
        $this->plantel = $plantel;
    }






}