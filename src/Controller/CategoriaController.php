<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;


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

    #[Route('/categoria/adicionar', name: 'categoria')]
    public function adicionar() : Response
    {
        $form = $this->createForm(CategoriaType::class);
        $data['titulo'] = 'Adicionar nova categoria';
        $data['form'] = $form;
         
        return $this->renderForm('categoria/form.html.twig', $data);
    }
}
