<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="type_visite")
 * @ORM\Entity(repositoryClass="App\Repository\TypeVisiteRepository")
 */
class TypeVisite
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
    private $type;

    /**
     * @ORM\Column(type="time")
     */
    private $creneau;

    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCreneau(): ?\DateTimeInterface
    {
        return $this->creneau;
    }

    public function setCreneau(\DateTimeInterface $creneau): self
    {
        $this->creneau = $creneau;

        return $this;
    }
}
