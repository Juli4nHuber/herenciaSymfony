<?php

namespace App\Entity;

use App\Repository\ArmaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArmaRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="Tipo", type="string")
 * @ORM\DiscriminatorMap({
 *      "Arco" = "Arco",
 *      "Espada" = "Espada"
 * })
 */
abstract class Arma
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer")
     */
    private $durabilidad;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDurabilidad(): ?int
    {
        return $this->durabilidad;
    }

    public function setDurabilidad(int $durabilidad): self
    {
        $this->durabilidad = $durabilidad;
        return $this;
    }
}
