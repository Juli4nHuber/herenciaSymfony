<?php

namespace App\Entity;

use App\Repository\ArcoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArcoRepository::class)
 */
class Arco extends Arma
{

    /**
     * @ORM\Column(type="integer")
     */
    private $cantFlechas;

    /**
     * @ORM\Column(type="integer")
     */
    private $rango;

    public function getCantFlechas(): ?int
    {
        return $this->cantFlechas;
    }

    public function setCantFlechas(int $cantFlechas): self
    {
        $this->cantFlechas = $cantFlechas;

        return $this;
    }

    public function getRango(): ?int
    {
        return $this->rango;
    }

    public function setRango(int $rango): self
    {
        $this->rango = $rango;
        return $this;
    }

    public function getClassName()
    {
        return (new \ReflectionClass($this))->getShortName();
    }

}
