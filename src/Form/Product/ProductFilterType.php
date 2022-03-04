<?php
namespace App\Form\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Imię",
                'empty_data' => "",
                'required' => false
            ])
            ->add('info', TextType::class, [
                'label' => "Nazwisko",
                'empty_data' => "",
                'required' => false
            ])
        ;
    }
}