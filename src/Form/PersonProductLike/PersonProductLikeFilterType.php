<?php
namespace App\Form\PersonProductLike;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonProductLikeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('person', TextType::class, [
                'label' => "Użytkownik",
                'empty_data' => "",
                'required' => false
            ])
            ->add('product', TextType::class, [
                'label' => "Product",
                'empty_data' => "",
                'required' => false
            ])
        ;
    }
}