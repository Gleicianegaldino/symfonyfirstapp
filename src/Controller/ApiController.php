<?php

namespace App\Controller;

use App\Repository\ProdutoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    
    public function produtos(ProdutoRepository $produtoRepository): Response
    {
     
            $listaProdutos = $produtoRepository->findAll();

            //Exibir no formato json (está pedindo pra serializar as informações dos produtos)
            return $this->json($listaProdutos, 200, [], ['groups' => ['api_list']]);


    }
}
