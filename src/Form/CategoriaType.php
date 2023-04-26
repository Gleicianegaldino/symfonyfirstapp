<?php


namespace App\Form;

use App\Entity\Categoria;
use Doctrine\DBAL\Types\TextType;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CategoriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options )
    {
        $builder
        ->add('descricaocategoria', TextType::class, 
        ['label' => 'Descrição da categoria: '])
        ->add('Salvar', SubmitType::class);
    }
}