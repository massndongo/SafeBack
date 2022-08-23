<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandPonctuelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandPonctuelRepository::class)
 * @ApiResource(
 *      denormalizationContext={"groups"={"command:write"}},
 * )
 */
class CommandPonctuel
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Medicament::class, inversedBy="commandPonctuels",cascade={"persist"})
     * @Groups("command:write")
     */
    private $medicament;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("command:write")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("command:write")
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("command:write")
     */
    private $numeroClient;

    public function __construct()
    {
        $this->medicament = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Medicament[]
     */
    public function getMedicament(): Collection
    {
        return $this->medicament;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicament->contains($medicament)) {
            $this->medicament[] = $medicament;
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        $this->medicament->removeElement($medicament);

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getNumeroClient(): ?string
    {
        return $this->numeroClient;
    }

    public function setNumeroClient(string $numeroClient): self
    {
        $this->numeroClient = $numeroClient;

        return $this;
    }
}
