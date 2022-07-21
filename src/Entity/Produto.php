<?php

namespace App\Entity;

use App\Repository\ProdutoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ProdutoRepository::class)]
class Produto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups("api_list")]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    #[Assert\NotBlank()]
    #[Groups("api_list")]
    #[Assert\Length(
        min: 5,
        max: 50,
        minMessage: 'O campo nome do produto deve conter mais de {{ limit }} caraceteres',
        maxMessage: 'O campo nome do produto deve conte no máximo {{ limit }} caraceteres',
    )]
    private $nomeproduto;

    #[ORM\Column(type: 'float')]
    #[Assert\NotBlank()]
    #[Groups("api_list")]
    #[Assert\Positive(
        message: "O campo valor deve ser positivo"
    )]

    private $valor;

    #[ORM\ManyToOne(targetEntity: Categoria::class, inversedBy: 'produtos')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups("api_list")]
    private $categoria;

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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }
}
