<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EstudianteRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Estudiante
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @var coordinador
     * @ORM\ManyToOne(targetEntity="User", inversedBy="estudiantes")
     * @ORM\JoinColumn(name="coordinador_id", referencedColumnName="id")
     */
    private $coordinador;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paterno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $materno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nivel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mail;

    /**
     * @ORM\Column(type="date")
     */
    private $nacimiento;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $puntuacion;

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
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $modifiedAt;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPaterno(): ?string
    {
        return $this->paterno;
    }

    public function setPaterno(string $paterno): self
    {
        $this->paterno = $paterno;

        return $this;
    }

    public function getMaterno(): ?string
    {
        return $this->materno;
    }

    public function setMaterno(string $materno): self
    {
        $this->materno = $materno;

        return $this;
    }

    public function getNivel(): ?string
    {
        return $this->nivel;
    }

    public function setNivel(string $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function getNacimiento(): ?\DateTimeInterface
    {
        return $this->nacimiento;
    }

    public function setNacimiento(\DateTimeInterface $nacimiento): self
    {
        $this->nacimiento = $nacimiento;

        return $this;
    }

    public function getPuntuacion(): ?string
    {
        return $this->puntuacion;
    }

    public function setPuntuacion(?string $puntuacion): self
    {
        $this->puntuacion = $puntuacion;

        return $this;
    }

    /**
     * Set coordinador
     *
     * @param string $coordinador
     * @return Estudiante
     */
    public function setCoordinador($coordinador)
    {
        $this->coordinador = $coordinador;

        return $this;
    }

    /**
     * Get coordinador
     *
     * @return string
     */
    public function getCoordinador()
    {
        return $this->coordinador;
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

}
