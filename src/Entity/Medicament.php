<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MedicamentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MedicamentRepository::class)
 */
class Medicament
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("command:write")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("command:write")
     */
    private $quantite;

    /**
     * @ORM\ManyToMany(targetEntity=CommandPonctuel::class, mappedBy="medicament")
     */
    private $commandPonctuels;

    public function __construct()
    {
        $this->commandPonctuels = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(?string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * @return Collection|CommandPonctuel[]
     */
    public function getCommandPonctuels(): Collection
    {
        return $this->commandPonctuels;
    }

    public function addCommandPonctuel(CommandPonctuel $commandPonctuel): self
    {
        if (!$this->commandPonctuels->contains($commandPonctuel)) {
            $this->commandPonctuels[] = $commandPonctuel;
            $commandPonctuel->addMedicament($this);
        }

        return $this;
    }

    public function removeCommandPonctuel(CommandPonctuel $commandPonctuel): self
    {
        if ($this->commandPonctuels->removeElement($commandPonctuel)) {
            $commandPonctuel->removeMedicament($this);
        }

        return $this;
    }
}
