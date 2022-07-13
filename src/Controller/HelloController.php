<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
 
    public function index(): Response
    {
       return new Response('<h1>ola</h1>');
    }

    public function helloname($name) : Response
    {
        return new Response('<h1>ola ' .$name. '</h1>');
    }
}
