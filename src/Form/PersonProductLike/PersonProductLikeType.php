<?php
namespace App\Form\PersonProductLike;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonProductLikeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('personId', HiddenType::class)
            ->add('productId', HiddenType::class)
        ;
    }
}