<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
   
    #[Route('/test', name:'test')]
    public function index(): Response
    {
        $data['titulo'] = 'Página de teste';
        $data['mensagem'] = 'Fazendo um teste';
        $data['frutas'] = [
            [
                'nome' => 'banana',
                'valor' => 123
            ],
            [
                'nome' => 'maça',
                'valor' => 23
            ],
        ];
        return $this->render('test/index.html.twig', $data);
    }

    /**
     *@Route("/test/detalhes/{id}") 
     */
    public function detalhes($id) : Response
    {
        return new Response('#'.$id.'');

    }
}
