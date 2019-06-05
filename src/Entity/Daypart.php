<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DaypartRepository")
 */
class Daypart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Workingday", inversedBy="dayparts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workingday;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Daypartstatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dayparttype")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getStatus(): ?Daypartstatus
    {
        return $this->status;
    }

    public function setStatus(?Daypartstatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?Dayparttype
    {
        return $this->type;
    }

    public function setType(?Dayparttype $type): self
    {
        $this->type = $type;

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
}
