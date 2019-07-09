<?php

namespace App\Entity\Notif;

use App\Entity\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\Annotation as Serializer;


/**
 * @ORM\Entity(repositoryClass="App\Repository\Notif\NotificationUserRepository")
 */
class NotificationUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"listNotifs"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User\User", inversedBy="notificationUsers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     * @Serializer\Groups({"listNotifs"})
     */
    private $seen = 0;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Notif\Notification", inversedBy="notificationUsers")
     * @ORM\JoinColumn(nullable=false)
     * @Serializer\Groups({"listNotifs"})
     */
    private $notification;

    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getNotification(): ?Notification
    {
        return $this->notification;
    }

    public function setNotification(?Notification $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function getSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }




}
