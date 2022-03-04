<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\Product\ProductFilterType;
use App\Form\Product\ProductType;
use App\Model\ProductFilter;
use App\Repository\ProductRepository;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/list", name="product_list")
     */
    public function productList(Request $request, ProductRepository $productRepository): Response
    {
        $filter = new ProductFilter();
        $filterForm = $this->createForm(ProductFilterType::class, $filter);

        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $filter = $filterForm->getData();
        }

        return $this->render('product/list.html.twig', [
            'products' => $productRepository->findFilteredProductList($filter),
            'filterForm' => $filterForm->createView()
        ]);
    }

    /**
     * @Route("/add", name="product_add")
     */
    public function productAdd(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($form->getData());

            $this->addFlash('success', "Pomyślnie dodano produkt!");

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/form.html.twig', [
            'form' => $form->createView(),
            'edit' => false
        ]);
    }

    /**
     * @Route("/edit/{product}", name="product_edit")
     */
    public function productEdit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->add($form->getData());

            $this->addFlash('success', "Pomyślnie edytowano produkt!");

            return $this->redirectToRoute('user_list');
        }

        return $this->render('product/form.html.twig', [
            'form' => $form->createView(),
            'edit' => true,
            'product' => $product
        ]);
    }

    /**
     * @Route("/delete/{product}", name="product_delete")
     */
    public function productDelete(Product $product, ProductRepository $productRepository): Response
    {
        $productRepository->remove($product);

        $this->addFlash('success', "Pomyślnie usunięto produkt!");

        return $this->redirectToRoute('product_list');
    }
}