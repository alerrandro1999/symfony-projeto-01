<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(): Response
    {
        return new Response('Pagina de teste');
    }

    /**
     *@Route("/test/detalhes/{id}") 
     */
    public function detalhes($id) : Response
    {
        return new Response('#'.$id.'');

    }
}
