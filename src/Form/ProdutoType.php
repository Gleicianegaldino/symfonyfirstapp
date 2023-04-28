<?php

namespace App\Form;

use App\Entity\Categoria;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;




class ProdutoType extends AbstractType
{
    public function  buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
            ->add('nomeproduto', TextType::class, [
                'required' => false,
               'label' => 'Nome do Produto: ',
               'constraints' => [
                   new Length([
                       'min' => 5,
                       'max' => 50,
                       'minMessage' => 'O mínimo de caracteres é: {{ limit }} ',
                       'maxMessage' => 'O maximo de caracteres é: {{ limit }} ',
                    ]),
                    new NotBlank([
                       'message' => 'Não pode ser nulo.'
                    ])
                   ]
           ])
            
            ->add('valor', TextType::class, ['label' => 'Valor: '])

            ->add('categoria', EntityType::class,['class' => Categoria::class,
            'choice_label' => 'descricaocategoria',
            'label' => 'Categoria: '
            ])
            ->add('Salvar', SubmitType::class);

    }
}