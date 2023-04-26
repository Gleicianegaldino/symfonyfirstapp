<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;



class ProdutoController extends AbstractController
{
    public function index(EntityManagerInterface $em, CategoriaRepository $categoriaRepository)
    {
        $categoria = $categoriaRepository->find(1);
        $produto = new Produto;
        $produto->setNomeproduto("Notebook");
        $produto->setValor(3000);
        $produto->setCategoria($categoria);

        $msg = "";
        
        try {
            $em->persist($produto);
            $em->flush();
            $msg = "Produto salvo";
        } catch (\Exception $e) {
            $msg = "Erro produto: " . $e->getMessage();
        }
        
        return new Response("<h1>" . $msg . "</h1>");
    }
    
        public function adicionar() : Response
        {
            $form = $this->createForm(ProdutoType::class);
            
            $data['titulo'] = 'Adicionar novo produto';   
            $data['form'] = $form;
           
            return $this->renderForm('produto/form.html.twig', $data);
        }
}