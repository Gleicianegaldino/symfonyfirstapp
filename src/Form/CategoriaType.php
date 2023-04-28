<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
//use Symfony\Component\Validator\Constraints\NotBlank;
//use Symfony\Component\Validator\Constraints as Assert;



class CategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
        ->add('descricaocategoria', TextType::class, [
             'required' => false,
            'label' => 'Descrição da categoria: ',
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
        ->add('Salvar', SubmitType::class);
    }
}