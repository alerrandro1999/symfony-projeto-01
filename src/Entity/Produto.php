<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nomeproduto;

    #[ORM\Column(type: 'float')]
    private $valor;

    #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    private $Entity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeproduto(): ?string
    {
        return $this->nomeproduto;
    }

    public function setNomeproduto(string $nomeproduto): self
    {
        $this->nomeproduto = $nomeproduto;

        return $this;
    }

    public function getValor(): ?float
    {
        return $this->valor;
    }

    public function setValor(float $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    public function getEntity(): ?Categoria
    {
        return $this->Entity;
    }

    public function setEntity(?Categoria $Entity): self
    {
        $this->Entity = $Entity;

        return $this;
    }
}
