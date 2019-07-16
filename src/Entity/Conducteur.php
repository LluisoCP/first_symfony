<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConducteurRepository")
 */
class Conducteur
{
    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le prénom doit contenir au moins trois caractéres."
     * )
     * @ORM\Column(type="string", length=31)
     */
    private $prenom;

    /**
     * @Assert\NotBlank(
     *      message = "Ce champ est obligatoire."
     * )
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Le nom doit contenir au moins trois caractéres."
     * )
     * @ORM\Column(type="string", length=31)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * Assert\NotBlank
     * @Assert\Email(
     *      message = "{{ value }} n'est pas une adresse mail valable."
     * )

     * @ORM\Column(type="string", length=63)
     */
    private $email;

    /**
     * Assert\GreaterThan(
     *      value = 17,
     *      message = "Message Erreur provenant de la class Conducteur."
     * )
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Voiture", inversedBy="conducteur", cascade={"persist", "remove"})
     */
    private $voiture;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
