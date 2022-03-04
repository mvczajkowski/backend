<?php
namespace App\Form\Person;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fName', TextType::class, [
                'label' => "Imię",
                'empty_data' => "",
                'required' => false
            ])
            ->add('lName', TextType::class, [
                'label' => "Nazwisko",
                'empty_data' => "",
                'required' => false
            ])
            ->add('login', TextType::class, [
                'label' => "Login",
                'empty_data' => "",
                'required' => false
            ])
        ;
    }
}