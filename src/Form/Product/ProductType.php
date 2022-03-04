<?php
namespace App\Form\Product;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nazwa"
            ])
            ->add('publicDate', TextType::class, [
                'label' => "Data opublikowania",
                'attr'=> ['autocomplete' => 'off']
            ])
            ->add('info', TextareaType::class, [
                'label' => "Opis"
            ])
        ;

        $builder->get('publicDate')
            ->addModelTransformer(new CallbackTransformer(
            function ($publicDateAsDatetime) {
                if ($publicDateAsDatetime === null) {
                    return "";
                }
                return $publicDateAsDatetime->format('d/m/Y');
            },
            function ($publicDateAsString) {
                // transform the string back to an array
                return new \DateTime($publicDateAsString);
            }
        ));
    }
}