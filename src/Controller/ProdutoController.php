<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    #[Route('/produto', name: 'produto')]
    public function index(EntityManagerInterface $em, CategoriaRepository $categoriaRepository): Response
    {
       $categoria = $categoriaRepository->find(1);
       $produto = new Produto();
       $produto->setNomeproduto("Notebook");
       $produto->setValor(3000);
       $produto->setEntity($categoria);

       $msg = "";

       try {
        $em->persist($produto);
        $em->flush();
        $msg = 'Produto cadastrada com sucesso';
      } catch (Exception $e) {
        $msg = 'Erro ao cadastrar produto';
      }
      return new Response($msg);

    }
}