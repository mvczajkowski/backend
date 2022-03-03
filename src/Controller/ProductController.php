<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/list", name="product_list")
     */
    public function productList(): Response
    {

        return $this->render('product/list.html.twig', []);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function productAdd(): Response
    {

        return $this->render('product/add.html.twig', []);
    }

    /**
     * @Route("/edit", name="product_edit")
     */
    public function productEdit(): Response
    {

        return $this->render('product/add.html.twig', []);
    }
}