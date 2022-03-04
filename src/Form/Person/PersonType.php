<?php
namespace App\Form\Person;

use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fName', TextType::class, [
                'label' => "Imię"
            ])
            ->add('lName', TextType::class, [
                'label' => "Nazwisko"
            ])
            ->add('login', TextType::class, [
                'label' => "Login"
            ])
            ->add('state', ChoiceType::class, [
                'label' => "Status",
                'choices' => [
                    Person::READABLE_STATES[Person::STATE_ACTIVE] => Person::STATE_ACTIVE,
                    Person::READABLE_STATES[Person::STATE_BANNED] => Person::STATE_BANNED,
                    Person::READABLE_STATES[Person::STATE_DELETED] => Person::STATE_DELETED
                ]
            ])
        ;
    }
}