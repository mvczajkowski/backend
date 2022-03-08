<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Person;
use App\Form\Person\PersonFilterType;
use App\Form\Person\PersonType;
use App\Model\PersonFilter;
use App\Repository\PersonRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/list", name="user_list")
     */
    public function userList(Request $request, PersonRepository $personRepository, PaginatorInterface $paginator): Response
    {
        $filter = new PersonFilter();
        $filterForm = $this->createForm(PersonFilterType::class, $filter);

        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $filter = $filterForm->getData();
        }

        $people = $paginator->paginate(
            $personRepository->findFilteredPersonListQuery($filter),
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('user/list.html.twig', [
            'people' => $people,
            'filterForm' => $filterForm->createView()
        ]);
    }

    /**
     * @Route("/add", name="user_add")
     */
    public function userAdd(Request $request, PersonRepository $personRepository): Response
    {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personRepository->add($form->getData());

            $this->addFlash('success', "Pomyślnie dodano użytkownika");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/form.html.twig', [
            'form' => $form->createView(),
            'edit' => false
        ]);
    }

    /**
     * @Route("/edit/{person}", name="user_edit")
     */
    public function userEdit(Request $request, Person $person, PersonRepository $personRepository): Response
    {
        $form = $this->createForm(PersonType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $personRepository->add($form->getData());

            $this->addFlash('success', "Pomyślnie edytowano użytkownika");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/form.html.twig', [
            'form' => $form->createView(),
            'edit' => true,
            'person' => $person
        ]);
    }

    /**
     * @Route("/delete/{person}", name="user_delete")
     */
    public function personDelete(Person $person, PersonRepository $personRepository): Response
    {
        $person->setState(Person::STATE_DELETED);
        $personRepository->add($person);

        $this->addFlash('success', "Pomyślnie usunięto użytkownika");

        return $this->redirectToRoute('user_list');
    }
}