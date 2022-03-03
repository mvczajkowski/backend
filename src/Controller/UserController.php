<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/list", name="user_list")
     */
    public function userList(): Response
    {

        return $this->render('user/list.html.twig', []);
    }

    /**
     * @Route("/add", name="user_add")
     */
    public function userAdd(): Response
    {

        return $this->render('user/add.html.twig', []);
    }

    /**
     * @Route("/edit", name="user_edit")
     */
    public function userEdit(): Response
    {

        return $this->render('user/add.html.twig', []);
    }
}