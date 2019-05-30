<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkingdayRepository")
 */
class Workingday
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Timeslot")
     */
    private $timeslots;

    public function __construct()
    {
        $this->timeslots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection|Timeslot[]
     */
    public function getTimeslots(): Collection
    {
        return $this->timeslots;
    }

    public function addTimeslot(Timeslot $timeslot): self
    {
        if (!$this->timeslots->contains($timeslot)) {
            $this->timeslots[] = $timeslot;
        }

        return $this;
    }

    public function removeTimeslot(Timeslot $timeslot): self
    {
        if ($this->timeslots->contains($timeslot)) {
            $this->timeslots->removeElement($timeslot);
        }

        return $this;
    }
}
