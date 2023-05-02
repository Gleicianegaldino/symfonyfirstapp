<?php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TesteController extends AbstractController
{

    public function hello() : Response
    {
        return new Response ('<h1>oi</h1>');
    }
}