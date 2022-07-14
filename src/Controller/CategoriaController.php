<?php

namespace App\Controller;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriaController extends AbstractController
{
    #[Route('/categoria', name: 'categoria')]
    public function index(EntityManagerInterface $em): Response
    {
       $categoria = new Categoria();
       $categoria->setDescricaocategoria("informatica");

      try {
        $em->persist($categoria);
        $em->flush();
        $msg = 'Categoria cadastrada com sucesso';
      } catch (Exception $e) {
        $msg = 'Erro ao cadastrada';
      }
      return new Response($msg);
    }
}
