<?php

namespace App\Controller;

use App\Entity\Categoria;
use App\Form\CategoriaType;
use App\Repository\CategoriaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriaController extends AbstractController
{
    public function index(CategoriaRepository $categoriaRepository) : Response
    {
        $data['categorias'] = $categoriaRepository->findAll();
        $data['titulo'] = 'Gerenciar Categorias';

        return $this->render('categoria/index.html.twig', $data);
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

        $data['titulo'] = 'Adicione uma nova categoria';
        $data['form'] = $form;

        return $this->renderForm('categoria/form.html.twig', $data);
    }

    public function editar($id, Request $request, EntityManagerInterface $em, CategoriaRepository $categoriaRepository): Response
    {
        $msg = "";
        $categoria = $categoriaRepository->find($id);
        $form = $this->createForm(CategoriaType::class, $categoria);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush(); 
            $msg = "Categoria atualizada!";
            return $this->redirectToRoute('categoria');
        }
        $data['titulo'] = "Editar categoria";
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderForm('categoria/form.html.twig', $data);
    }

    public function excluir($id, EntityManagerInterface $em, CategoriaRepository $categoriaRepository): Response
    {
        $categoria = $categoriaRepository->find($id); 
        $em->remove($categoria); 
        $em->flush();

        return $this->redirectToRoute('categoria');
    }
}
