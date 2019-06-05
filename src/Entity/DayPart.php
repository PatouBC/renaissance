<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DayPartRepository")
 */
class DayPart
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\WorkingDay", inversedBy="dayparts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $workingDay;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DayPartStatus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\DayPartType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Typeconsult")
     */
    private $consult;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWorkingDay(): ?WorkingDay
    {
        return $this->workingDay;
    }

    public function setWorkingDay(?WorkingDay $workingDay): self
    {
        $this->workingDay = $workingDay;

        return $this;
    }

    public function getStatus(): ?DayPartStatus
    {
        return $this->status;
    }

    public function setStatus(?DayPartStatus $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getType(): ?DayPartType
    {
        return $this->type;
    }

    public function setType(?DayPartType $type): self
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

    public function getConsult(): ?Typeconsult
    {
        return $this->consult;
    }

    public function setConsult(?Typeconsult $consult): self
    {
        $this->consult = $consult;

        return $this;
    }
}
