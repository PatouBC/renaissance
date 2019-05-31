<?php

namespace App\Entity;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Timeslot", inversedBy="workingdays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $timeslot;

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

    public function getTimeslot(): ?Timeslot
    {
        return $this->timeslot;
    }

    public function setTimeslot(?Timeslot $timeslot): self
    {
        $this->timeslot = $timeslot;

        return $this;
    }
}
