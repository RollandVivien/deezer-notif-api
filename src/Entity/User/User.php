<?php

namespace App\Entity\User;

use App\Entity\Notif\NotificationUser;
use App\Entity\Playlist;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\User\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Music\Playlist", mappedBy="author", orphanRemoval=true)
     */
    private $playlists;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notif\NotificationUser", mappedBy="user", orphanRemoval=true)
     */
    private $notificationUsers;

    public function __construct()
    {
        $this->playlists = new ArrayCollection();
        $this->notificationUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
            $playlist->setAuthor($this);
        }

        return $this;
    }

    public function removePlaylist(Playlist $playlist): self
    {
        if ($this->playlists->contains($playlist)) {
            $this->playlists->removeElement($playlist);
            // set the owning side to null (unless already changed)
            if ($playlist->getAuthor() === $this) {
                $playlist->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|NotificationUser[]
     */
    public function getNotificationUsers(): Collection
    {
        return $this->notificationUsers;
    }

    public function addNotificationUser(NotificationUser $notificationUser): self
    {
        if (!$this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers[] = $notificationUser;
            $notificationUser->setUser($this);
        }

        return $this;
    }

    public function removeNotificationUser(NotificationUser $notificationUser): self
    {
        if ($this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers->removeElement($notificationUser);
            // set the owning side to null (unless already changed)
            if ($notificationUser->getUser() === $this) {
                $notificationUser->setUser(null);
            }
        }

        return $this;
    }
}
