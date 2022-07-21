<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoriaController extends AbstractController
{
    #[Route('/categoria', name: 'categoria')]
    #[IsGranted('ROLE_USER')]
    public function index(CategoriaRepository $categoriaRepository): Response
    {
    //   $this->denyAccessUnlessGranted('ROLE_USER');  
      $data['categorias'] = $categoriaRepository->findAll();
      $data['titulo'] = 'Gerenciar Categorias';
      return $this->render('categoria/index.html.twig', $data);
    }

    #[Route('/categoria/adicionar', name: 'categoriaAdicionar')]
    #[IsGranted('ROLE_USER')]
    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $categoria = new Categoria();
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($categoria);
            $em->flush();
            $msg = "Categoria adicionar com sucesso";
        }

        $data['titulo'] = 'Adicionar nova categoria';
        $data['form'] = $form;
        $data['msg'] = $msg;
        return $this->renderForm('categoria/form.html.twig', $data);
    }

    #[Route('/categoria/editar/{id}', name: 'categoriaEditar',)]
    #[IsGranted('ROLE_USER')]
    public function editar($id, Request $request, EntityManagerInterface $em, CategoriaRepository $categoriaRepository) : Response
    {
        $msg = '';
        $categoria = $categoriaRepository->find($id);
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $em->flush();
          $msg = 'Produto atualizado com sucesso';
        }

        $data['titulo'] = 'Atualizar categoria';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('categoria/form.html.twig', $data);
    }

    #[Route('/categoria/excluir/{id}', name: 'categoriaExcluir',)]
    #[IsGranted('ROLE_USER')]
    public function excluir($id, EntityManagerInterface $em, CategoriaRepository $categoriaRepository) : Response
    {
        $categoria = $categoriaRepository->find($id);
        $em->remove($categoria);
        $em->flush();

        return $this->redirectToRoute('categoria');
    }

}
