<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"NONE")]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $site;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\OneToMany(mappedBy: 'artiste', targetEntity: Album::class)]
    private $albums;  // Changement de "albums" en "albums"

    public function __construct()
    {
        $this->albums = new ArrayCollection();  // Changement ici aussi
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSite(): ?string
    {
        return $this->site;
    }

    public function setSite(?string $site): self
    {
        $this->site = $site;

        return $this;
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getAlbums(): Collection  // Changement ici aussi
    {
        return $this->albums;  // Changement ici aussi
    }

    public function addAlbum(Album $album): self  // Changement de "albulm" en "album"
    {
        if (!$this->albums->contains($album)) {  // Changement ici aussi
            $this->albums[] = $album;  // Changement ici aussi
            $album->setArtiste($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self  // Changement de "albulm" en "album"
    {
        if ($this->albums->removeElement($album)) {  // Changement ici aussi
            // set the owning side to null (unless already changed)
            if ($album->getArtiste() === $this) {  // Changement ici aussi
                $album->setArtiste(null);  // Changement ici aussi
            }
        }

        return $this;
    }
}
