<?php

namespace App\Entity\Notif;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Notif\NotificationRepository")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expiredAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notif\NotificationUser", mappedBy="notification", orphanRemoval=true)
     */
    private $notificationUsers;

    public function __construct()
    {
        $this->notificationUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getExpiredAt(): ?\DateTimeInterface
    {
        return $this->expiredAt;
    }

    public function setExpiredAt(?\DateTimeInterface $expiredAt): self
    {
        $this->expiredAt = $expiredAt;

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
            $notificationUser->setNotification($this);
        }

        return $this;
    }

    public function removeNotificationUser(NotificationUser $notificationUser): self
    {
        if ($this->notificationUsers->contains($notificationUser)) {
            $this->notificationUsers->removeElement($notificationUser);
            // set the owning side to null (unless already changed)
            if ($notificationUser->getNotification() === $this) {
                $notificationUser->setNotification(null);
            }
        }

        return $this;
    }
}
