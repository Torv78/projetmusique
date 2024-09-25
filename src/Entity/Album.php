<?php

namespace App\Entity;

use App\Entity\Artiste;
use App\Entity\Morceau;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album 
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy:"IDENTITY")]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'integer')]
    private $date;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Artiste::class, inversedBy: 'albums')]  // Correction ici aussi
    #[ORM\JoinColumn(nullable: false)]
    private $artiste;

    #[ORM\OneToMany(mappedBy: 'album', targetEntity: Morceau::class)]  // Correction ici aussi
    private $morceaux;

    #[ORM\ManyToMany(targetEntity: Style::class, mappedBy: 'albums')]
    private Collection $styles;

    public function __construct()
    {
        $this->morceaux = new ArrayCollection();
        $this->styles = new ArrayCollection();
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

    public function getDate(): ?int
    {
        return $this->date;
    }

    public function setDate(int $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getArtiste(): ?Artiste  // Correction de "artiste" en "Artiste" (nom de classe)
    {
        return $this->artiste;
    }

    public function setArtiste(?Artiste $artiste): self  // Correction ici aussi
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * @return Collection<int, Morceau>
     */
    public function getMorceaux(): Collection
    {
        return $this->morceaux;
    }

    public function addMorceaux(Morceau $morceaux): self
    {
        if (!$this->morceaux->contains($morceaux)) {
            $this->morceaux[] = $morceaux;
            $morceaux->setAlbum($this);  // Correction ici aussi
        }

        return $this;
    }

    public function removeMorceaux(Morceau $morceaux): self
    {
        if ($this->morceaux->removeElement($morceaux)) {
            // set the owning side to null (unless already changed)
            if ($morceaux->getAlbum() === $this) {  // Correction ici aussi
                $morceaux->setAlbum(null);  // Correction ici aussi
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Style>
     */
    public function getStyles(): Collection
    {
        return $this->styles;
    }

    public function addStyle(Style $style): static
    {
        if (!$this->styles->contains($style)) {
            $this->styles->add($style);
            $style->addAlbum($this);
        }

        return $this;
    }

    public function removeStyle(Style $style): static
    {
        if ($this->styles->removeElement($style)) {
            $style->removeAlbum($this);
        }

        return $this;
    }
}
