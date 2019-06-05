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
     * @ORM\Column(type="string", length=2)
     */
    private $daydate;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $daymonth;

    /**
     * @ORM\Column(type="string", length=4)
     */
    private $dayyear;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Daypart", mappedBy="workingday", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $dayparts;

    public function __construct()
    {
        $this->dayparts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDaydate(): ?string
    {
        return $this->daydate;
    }

    public function setDaydate(string $daydate): self
    {
        $this->daydate = $daydate;

        return $this;
    }

    public function getDaymonth(): ?string
    {
        return $this->daymonth;
    }

    public function setDaymonth(string $daymonth): self
    {
        $this->daymonth = $daymonth;

        return $this;
    }

    public function getDayyear(): ?string
    {
        return $this->dayyear;
    }

    public function setDayyear(string $dayyear): self
    {
        $this->dayyear = $dayyear;

        return $this;
    }

    /**
     * @return Collection|Daypart[]
     */
    public function getDayparts(): Collection
    {
        return $this->dayparts;
    }

    public function addDaypart(Daypart $daypart): self
    {
        if (!$this->dayparts->contains($daypart)) {
            $this->dayparts[] = $daypart;
            $daypart->setWorkingday($this);
        }

        return $this;
    }

    public function removeDaypart(Daypart $daypart): self
    {
        if ($this->dayparts->contains($daypart)) {
            $this->dayparts->removeElement($daypart);
            // set the owning side to null (unless already changed)
            if ($daypart->getWorkingday() === $this) {
                $daypart->setWorkingday(null);
            }
        }

        return $this;
    }
}
