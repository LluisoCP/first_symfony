<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @UniqueEntity("Immatriculation")
 * 
 * @ORM\Entity(repositoryClass="App\Repository\VoitureRepository")
 */
class Voiture
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
     *      minMessage = "Message d'erreur de Voiture (Entity): La marque doit contenir au moins trois caractères."
     * )
     * @ORM\Column(type="string", length=31)
     */
    private $Marque;

    /**
     * @Assert\Length(
     *      min = 2,
     *      minMessage = "Le modèle doit contenir au moins deux caractères."
     * )
     * @ORM\Column(type="string", length=63)
     */
    private $Modele;

    /**
     * @Assert\Length(
     *      min = 4,
     *      minMessage = "L'immatriculation doit contenir au moins quatre caractères."
     * )
     * @ORM\Column(type="string", length=15)
     */
    private $Immatriculation;

    /**
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "La couleur doit contenir au moins trois caratères."
     * )
     * @ORM\Column(type="string", length=31)
     */
    private $Couleur;

    /**
     * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Conducteur", mappedBy="voiture", cascade={"persist", "remove"})
     */
    private $conducteur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->Marque;
    }

    public function setMarque(string $Marque): self
    {
        $this->Marque = $Marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->Immatriculation;
    }

    public function setImmatriculation(string $Immatriculation): self
    {
        $this->Immatriculation = $Immatriculation;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->Couleur;
    }

    public function setCouleur(string $Couleur): self
    {
        $this->Couleur = $Couleur;

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

    public function getConducteur(): ?Conducteur
    {
        return $this->conducteur;
    }

    public function setConducteur(?Conducteur $conducteur): self
    {
        $this->conducteur = $conducteur;

        // set (or unset) the owning side of the relation if necessary
        $newVoiture = $conducteur === null ? null : $this;
        if ($newVoiture !== $conducteur->getVoiture()) {
            $conducteur->setVoiture($newVoiture);
        }

        return $this;
    }
}
