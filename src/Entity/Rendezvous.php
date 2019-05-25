<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RendezvousRepository")
 */
class Rendezvous
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
     * @ORM\Column(type="integer")
     */
    private $timeslot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $confirm;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typeconsult")
     * @ORM\JoinColumn(nullable=false)
     */
    private $typeconsult;

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

    public function getTimeslot(): ?int
    {
        return $this->timeslot;
    }

    public function setTimeslot(int $timeslot): self
    {
        $this->timeslot = $timeslot;

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

    public function getTypeconsult(): ?Typeconsult
    {
        return $this->typeconsult;
    }

    public function setTypeconsult(?Typeconsult $typeconsult): self
    {
        $this->typeconsult = $typeconsult;

        return $this;
    }
}
