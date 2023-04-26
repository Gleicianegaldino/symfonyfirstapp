<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends AbstractController
{
    public function index(EntityManagerInterface $em): Response
    {
        $categoria = new Categoria();
        $categoria->setDescricaocategoria("Informática");
        $msg = "";
        
        try {
            $em->persist($categoria);
            $em->flush();
            $msg = "Categoria salva";
        } catch (\Exception $e) {
            $msg = "Erro: " . $e->getMessage();
        }
        
        return new Response("<h1>" . $msg . "</h1>");
    }

    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $categoria = new Categoria();

        $form = $this->createForm(CategoriaType::class, $categoria);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($categoria);
            $em->flush();
        }

        $data['titulo'] = 'Adicionar nova categoria';
        $data['form'] = $form;

        return $this->renderForm('categoria/form.html.twig', $data);
    }
}
