<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255)
     */
    private $description;

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
    private $confirm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Workingday", mappedBy="timeslot")
     */
    private $workingdays;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typeconsult")
     */
    private $typeconsult;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="timeslot")
     */
    private $user;

    public function __construct()
    {
        $this->workingdays = new ArrayCollection();
        $this->user = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getConfirm(): ?bool
    {
        return $this->confirm;
    }

    public function setConfirm(bool $confirm): self
    {
        $this->confirm = $confirm;

        return $this;
    }

    /**
     * @return Collection|Workingday[]
     */
    public function getWorkingdays(): Collection
    {
        return $this->workingdays;
    }

    public function addWorkingday(Workingday $workingday): self
    {
        if (!$this->workingdays->contains($workingday)) {
            $this->workingdays[] = $workingday;
            $workingday->setTimeslot($this);
        }

        return $this;
    }

    public function removeWorkingday(Workingday $workingday): self
    {
        if ($this->workingdays->contains($workingday)) {
            $this->workingdays->removeElement($workingday);
            // set the owning side to null (unless already changed)
            if ($workingday->getTimeslot() === $this) {
                $workingday->setTimeslot(null);
            }
        }

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

    /**
     * @return Collection|User[]
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user[] = $user;
            $user->setTimeslot($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->contains($user)) {
            $this->user->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getTimeslot() === $this) {
                $user->setTimeslot(null);
            }
        }

        return $this;
    }
}
