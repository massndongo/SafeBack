<?php

namespace App\Entity;

use Webmozart\Assert\Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommandRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"command:read"}},
 *  collectionOperations={
 *          "POST":{
 *              "method":"POST",
 *              "path":"/commandes/ordonnance"
 *          },
 *  },
 *  itemOperations={
 *          "getCommand"={
 *              "path"="/command/{id}",
 *              "method"="GET"
 *          },
 * }
 * )
 */
class Command
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("command:read")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     * @Groups("command:read")
     */
    private $dateCommand;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("command:read")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("command:read")
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("command:read")
     */
    private $numeroClient;

    /**
     * @ORM\Column(type="blob", nullable=true)
     * @Groups("command:read")
     */
    private $ordonnance;


    public function __construct()
    {

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommand(): ?\DateTimeInterface
    {
        return $this->dateCommand;
    }

    public function setDateCommand(\DateTimeInterface $dateCommand): self
    {
        $this->dateCommand = $dateCommand;

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

    public function setNomClient(?string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getNumeroClient(): ?string
    {
        return $this->numeroClient;
    }

    public function setNumeroClient(?string $numeroClient): self
    {
        $this->numeroClient = $numeroClient;

        return $this;
    }

    public function getOrdonnance()
    {
        if ($this->ordonnance) {
            return base64_encode(stream_get_contents($this->ordonnance));
        } else {
            return null;
        }
    }

    public function setOrdonnance($ordonnance): self
    {
        $this->ordonnance = $ordonnance;

        return $this;
    }
}
