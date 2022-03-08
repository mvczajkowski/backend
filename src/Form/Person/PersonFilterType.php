<?php
namespace App\Form\Person;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('state', ChoiceType::class, [
                'label' => "Status",
                'empty_data' => "",
                'required' => false,
                'choices' => [
                    "Wszystkie" => 0,
                    Person::READABLE_STATES[Person::STATE_ACTIVE] => Person::STATE_ACTIVE,
                    Person::READABLE_STATES[Person::STATE_BANNED] => Person::STATE_BANNED,
                    Person::READABLE_STATES[Person::STATE_DELETED] => Person::STATE_DELETED
                ]
            ])
        ;
    }
}