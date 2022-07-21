<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProdutoController extends AbstractController
{
    #[Route('/produto', name: 'produto')]
    public function index(ProdutoRepository $produtosRepository): Response
    {
       $data['produtos'] = $produtosRepository->findAll();
       $data['titulo'] = "Gerenciar Produtos";

       return $this->render('produto/index.html.twig', $data);

    }

    #[Route('/produto/adicionar', name: 'produtoAdicionar')]
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
       $msg = '';
       $produto = new Produto();
       $form = $this->createForm(ProdutoType::class, $produto);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
          $em->persist($produto);
          $em->flush();
          $msg = "Produto cadastrado com sucesso";
       }

       $data['titulo'] = "Adicionar novo produto";
       $data['form'] = $form;
       $data['msg'] = $msg;

       return $this->renderForm('produto/form.html.twig', $data);
    }

    #[Route('/produto/editar/{id}', name: 'produtoEditar')]
    public function editar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtosRepository) : Response
    {
      $msg = '';
      $produto = $produtosRepository->find($id);
      $form = $this->createForm(ProdutoType::class, $produto);
      $form->handleRequest($request);

      
      if ($form->isSubmitted() && $form->isValid()) {
        $em->flush();
        $msg = "Produto atualizado com sucesso";
     }

     $data['titulo'] = "Editar produto";
     $data['form'] = $form;
     $data['msg'] = $msg;

     return $this->renderForm('produto/form.html.twig', $data);
    }

    #[Route('/produto/excluir/{id}', name: 'produtoExcluir')]
    public function excluir($id, EntityManagerInterface $em, ProdutoRepository $produtosRepository) : Response
    {
      $produto = $produtosRepository->find($id);
      $em->remove($produto);
      $em->flush();
      
      return $this->redirectToRoute('produto');
    }

}
