<?php

namespace App\Service;

use App\Repository\PersonRepository;
use App\Entity\Person;

class PersonService
{
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function getAllPersons()
    {
        return $this->personRepository->findAll();
    }
}