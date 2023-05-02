<?php

namespace App\Controller;

use App\Entity\Produto;
use App\Form\ProdutoType;
use App\Repository\ProdutoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdutoController extends AbstractController
{
    public function index(Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository)
    {
        $nomeproduto = $request->query->get('nome');
        //restringir a pagina apenas aos ROLES_USER
        $this->denyAccessUnlessGranted('ROLE_USER');
        
        $data['produtos'] = is_null($nomeproduto)
                            ? $produtoRepository->findAll()
                            : $produtoRepository->findProdutoByLikeNome($nomeproduto);
        //$produtoRepository->findAll();
        $data['nomeproduto'] = $nomeproduto;
        $data['titulo'] = 'Gerenciar Produtos';

        return $this->render("produto/index.html.twig", $data);
    }

    public function adicionar(Request $request, EntityManagerInterface $em): Response
    {
        $produto = new Produto();
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto');
        }

        $data['titulo'] = "Adicionar novo produto";
        $data['form'] = $form;

        return $this->renderForm('produto/form.html.twig', $data);
    }
    public function editar($id, Request $request, EntityManagerInterface $em, ProdutoRepository $produtoRepository): Response
    {
        $produto = $produtoRepository->find($id);
        $form = $this->createForm(ProdutoType::class, $produto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $em->persist($produto);
            $em->flush();

            return $this->redirectToRoute('produto');
        }

        $data['titulo'] = "Editar novo produto";
        $data['form'] = $form;

        return $this->renderForm('produto/form.html.twig', $data);
    }
    public function excluir($id, EntityManagerInterface $em, ProdutoRepository $produtoRepository): Response
    {
        $produto = $produtoRepository->find($id); 
        $em->remove($produto); 
        $em->flush(); 

        return $this->redirectToRoute('produto');
    }
}