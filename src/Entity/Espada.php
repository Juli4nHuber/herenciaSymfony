<?php

namespace App\Entity;

use App\Repository\EspadaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EspadaRepository::class)
 */
class Espada extends Arma
{


    /**
     * @ORM\Column(type="integer")
     */
    private $critico;

    /**
     * @ORM\Column(type="integer")
     */
    private $letalidad;

    public function getCritico(): ?string
    {
        return $this->critico;
    }

    public function setCritico(int $critico): self
    {
        $this->critico = $critico;

        return $this;
    }

    public function getLetalidad(): ?int
    {
        return $this->letalidad;
    }

    public function setLetalidad(int $letalidad): self
    {
        $this->letalidad = $letalidad;
        return $this;
    }

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

}
