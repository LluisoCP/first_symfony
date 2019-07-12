<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SportRepository")
 */
class Sport
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbjoueurs;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $formeBallon;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $surfaceTerrain;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNbjoueurs(): ?int
    {
        return $this->nbjoueurs;
    }

    public function setNbjoueurs(int $nbjoueurs): self
    {
        $this->nbjoueurs = $nbjoueurs;

        return $this;
    }

    public function getFormeBallon(): ?string
    {
        return $this->formeBallon;
    }

    public function setFormeBallon(?string $formeBallon): self
    {
        $this->formeBallon = $formeBallon;

        return $this;
    }

    public function getSurfaceTerrain(): ?int
    {
        return $this->surfaceTerrain;
    }

    public function setSurfaceTerrain(?int $surfaceTerrain): self
    {
        $this->surfaceTerrain = $surfaceTerrain;

        return $this;
    }

    public function description()
    {
        $description = "It takes " .  $this->getNbjoueurs() . " players to play " . $this->getNom() . " and a court " .  $this->getSurfaceTerrain() . "m² size. It's played with a ball that is " . $this->getFormeBallon() . ".";
        return $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
