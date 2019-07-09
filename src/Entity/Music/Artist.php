<?php

namespace App\Entity\Music;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\Music\ArtistRepository")
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"listNotifs"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"listNotifs"})
     */
    private $stageName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Serializer\Groups({"listNotifs"})
     */
    private $coverImgUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Music\Album", mappedBy="artist")
     */
    private $albums;

    public function __construct()
    {
        $this->albums = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStageName(): ?string
    {
        return $this->stageName;
    }

    public function setStageName(string $stageName): self
    {
        $this->stageName = $stageName;

        return $this;
    }

    public function getCoverImgUrl(): ?string
    {
        return $this->coverImgUrl;
    }

    public function setCoverImgUrl(string $coverImgUrl): self
    {
        $this->coverImgUrl = $coverImgUrl;

        return $this;
    }

    /**
     * @return Collection|Album[]
     */
    public function getAlbums(): Collection
    {
        return $this->albums;
    }

    public function addAlbum(Album $album): self
    {
        if (!$this->albums->contains($album)) {
            $this->albums[] = $album;
            $album->setArtist($this);
        }

        return $this;
    }

    public function removeAlbum(Album $album): self
    {
        if ($this->albums->contains($album)) {
            $this->albums->removeElement($album);
            // set the owning side to null (unless already changed)
            if ($album->getArtist() === $this) {
                $album->setArtist(null);
            }
        }

        return $this;
    }
}
