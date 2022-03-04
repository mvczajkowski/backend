<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PersonService;

/**
 * @Route("/person")
 */
class PersonController extends AbstractController
{
    /**
     * @Route("/list", name="person_list")
     */
    public function personList(PersonService $personService): Response
    {
        return $this->render('person/list.html.twig', [
            'persons' => $personService->getAllPersons()
        ]);
    }

    /**
     * @Route("/add", name="person_add")
     */
    public function personAdd(): Response
    {

        return $this->render('person/add.html.twig', []);
    }

    /**
     * @Route("/edit", name="person_edit")
     */
    public function personEdit(): Response
    {

        return $this->render('person/add.html.twig', []);
    }
}