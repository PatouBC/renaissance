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
     * @ORM\Column(type="string", length=255)
     */
    private $year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $month;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $day;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Timeslot", cascade={"all"}, orphanRemoval=true, mappedBy="workingday")
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

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getMonth(): ?string
    {
        return $this->month;
    }

    public function setMonth(string $month): self
    {
        $this->month = $month;

        return $this;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

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
            $timeslot->setWorkingday($this);
        }

        return $this;
    }

    public function removeTimeslot(Timeslot $timeslot): self
    {
        if ($this->timeslots->contains($timeslot)) {
            $this->timeslots->removeElement($timeslot);
            // set the owning side to null (unless already changed)
            if ($timeslot->getWorkingday() === $this) {
                $timeslot->setWorkingday(null);
            }
        }

        return $this;
    }


}
