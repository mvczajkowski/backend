<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/like")
 */
class LikeController extends AbstractController
{
    /**
     * @Route("/list", name="like_list")
     */
    public function likeList(): Response
    {

        return $this->render('like/list.html.twig', []);
    }

    /**
     * @Route("/add", name="like_add")
     */
    public function likeAdd(): Response
    {

        return $this->render('like/add.html.twig', []);
    }

    /**
     * @Route("/edit", name="like_edit")
     */
    public function likeEdit(): Response
    {

        return $this->render('like/add.html.twig', []);
    }
}