<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $name;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $effect;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Indication", inversedBy="products")
     */
    private $indications;

    public function __construct()
    {
        $this->indications = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): self
    {
        $this->effect = $effect;

        return $this;
    }

    /**
     * @return Collection|Indication[]
     */
    public function getIndications(): Collection
    {
        return $this->indications;
    }

    public function addIndication(Indication $indication): self
    {
        if (!$this->indications->contains($indication)) {
            $this->indications[] = $indication;
        }

        return $this;
    }

    public function removeIndication(Indication $indication): self
    {
        if ($this->indications->contains($indication)) {
            $this->indications->removeElement($indication);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }
}
