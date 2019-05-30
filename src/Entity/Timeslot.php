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
    private $confirm;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

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

    public function getConfirm(): ?bool
    {
        return $this->confirm;
    }

    public function setConfirm(bool $confirm): self
    {
        $this->confirm = $confirm;

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

    public function __toString()
    {
        return $this->getDescription();
    }
}
