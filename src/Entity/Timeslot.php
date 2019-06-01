<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TimeslotRepository")
 */
class Timeslot
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $slot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $dispo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $wait;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirmed;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="timeslots")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typeconsult")
     */
    private $typeconsult;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workingday", inversedBy="timeslots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workingday;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlot(): ?int
    {
        return $this->slot;
    }

    public function setSlot(int $slot): self
    {
        $this->slot = $slot;

        return $this;
    }

    public function getDispo(): ?bool
    {
        return $this->dispo;
    }

    public function setDispo(bool $dispo): self
    {
        $this->dispo = $dispo;

        return $this;
    }

    public function getWait(): ?bool
    {
        return $this->wait;
    }

    public function setWait(bool $wait): self
    {
        $this->wait = $wait;

        return $this;
    }

    public function getConfirmed(): ?bool
    {
        return $this->confirmed;
    }

    public function setConfirmed(bool $confirmed): self
    {
        $this->confirmed = $confirmed;

        return $this;
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

    public function getTypeconsult(): ?Typeconsult
    {
        return $this->typeconsult;
    }

    public function setTypeconsult(?Typeconsult $typeconsult): self
    {
        $this->typeconsult = $typeconsult;

        return $this;
    }

    public function getWorkingday(): ?Workingday
    {
        return $this->workingday;
    }

    public function setWorkingday(?Workingday $workingday): self
    {
        $this->workingday = $workingday;

        return $this;
    }
}
