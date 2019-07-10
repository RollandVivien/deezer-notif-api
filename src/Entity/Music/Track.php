<?php

namespace App\Entity\Music;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\Music\TrackRepository")
 */
class Track
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
    private $title;

    /**
     * @ORM\Column(type="float")
     * @Serializer\Groups({"listNotifs"})
     */
    private $duration;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Music\Album", inversedBy="tracks")
     * @Serializer\Groups({"listNotifs"})
     */
    private $album;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Music\Playlist", inversedBy="tracks")
     */
    private $playlists;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Music\Artist", inversedBy="tracks")
     */
    private $artist;


    public function __construct()
    {
        $this->playlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    /**
     * @return Collection|Playlist[]
     */
    public function getPlaylists(): Collection
    {
        return $this->playlists;
    }

    public function addPlaylist(Playlist $playlist): self
    {
        if (!$this->playlists->contains($playlist)) {
            $this->playlists[] = $playlist;
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->contains($playlist)) {
            $this->playlists->removeElement($playlist);
        }

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }
}
