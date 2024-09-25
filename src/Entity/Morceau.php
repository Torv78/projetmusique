<?php

namespace App\Entity;

use App\Entity\Album;
use App\Entity\Morceau;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MorceauRepository;

#[ORM\Entity(repositoryClass: MorceauRepository::class)]
class Morceau
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"NONE")]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $titre;

    #[ORM\Column(type: 'string', length: 255)]
    private $duree;

    #[ORM\ManyToOne(targetEntity: Album::class, inversedBy: 'morceaux')]
    #[ORM\JoinColumn(nullable: false)]
    private $album;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(string $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->albulm;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }
}
