<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Person;
use App\Entity\Product;
use App\Form\PersonProductLike\PersonProductLikeFilterType;
use App\Form\PersonProductLike\PersonProductLikeType;
use App\Model\PersonProductLike\PersonProductLikeFilter;
use App\Model\PersonProductLike\PersonProductLikeModel;
use App\Repository\PersonProductLikeRepository;
use App\Service\LikeService;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/like")
 */
class LikeController extends AbstractController
{
    /**
     * @Route("/list", name="like_list")
     */
    public function likeList(Request $request, PersonProductLikeRepository $personProductLikeRepository, PaginatorInterface $paginator): Response
    {
        $filter = new PersonProductLikeFilter();
        $filterForm = $this->createForm(PersonProductLikeFilterType::class, $filter);

        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $filter = $filterForm->getData();
        }

        $personProductLikes = $paginator->paginate(
            $personProductLikeRepository->findFilteredPersonProductLikeListQuery($filter),
            $request->query->getInt('page', 1),
            20,
            [Paginator::DISTINCT => false]
        );

        return $this->render('like/list.html.twig', [
            'personProductLikes' => $personProductLikes,
            'filterForm' => $filterForm->createView()
        ]);
    }

    /**
     * @Route("/add", name="like_add")
     */
    public function likeAdd(Request $request, PersonProductLikeRepository $personProductLikeRepository, LikeService $likeService): Response
    {
        $personProductLikeModel = new PersonProductLikeModel();
        $form = $this->createForm(PersonProductLikeType::class, $personProductLikeModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $likeService->createNewLike($personProductLikeModel);

            $this->addFlash($message['type'], $message['message']);

            $redirectTarget = $message['type'] === "success" ? "like_list" : "like_add";

            return $this->redirectToRoute($redirectTarget);
        }

        return $this->render('like/form.html.twig', [
            'form' => $form->createView(),
            'edit' => false
        ]);
    }

    /**
     * @Route("/edit/{person}/{product}", name="like_edit")
     */
    public function likeEdit(
        Request $request,
        Person $person,
        Product $product,
        PersonProductLikeRepository $personProductLikeRepository,
        LikeService $likeService
    ): Response
    {
        $personProductLike = $personProductLikeRepository->findOneBy(['person' => $person, 'product' => $product]);
        $personProductLikeModel = new PersonProductLikeModel();
        $form = $this->createForm(PersonProductLikeType::class, $personProductLikeModel);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = $likeService->editLike($personProductLike, $personProductLikeModel);

            $this->addFlash($message['type'], $message['message']);

            $redirectTarget = $message['type'] === "success" ? "like_list" : "like_add";

            return $this->redirectToRoute($redirectTarget);
        }

        return $this->render('like/form.html.twig', [
            'form' => $form->createView(),
            'edit' => true,
            'personProductLike' => $personProductLike
        ]);
    }

    /**
     * @Route("/person/ajax", name="like_person_ajax")
     */
    public function personAjax(Request $request, LikeService $likeService): Response
    {
        return new JsonResponse($likeService->getPeopleForLikeSelect($request->query->get('term') ?? ""));
    }

    /**
     * @Route("/product/ajax", name="like_product_ajax")
     */
    public function productAjax(Request $request, LikeService $likeService): Response
    {
        return new JsonResponse($likeService->getProductsForLikeSelect($request->query->get('term') ?? ""));
    }

    /**
     * @Route("/delete/{person}/{product}", name="like_delete")
     */
    public function likeDelete(Person $person, Product $product, PersonProductLikeRepository $personProductLikeRepository): Response
    {
        $personProductLike = $personProductLikeRepository->findOneBy(['person' => $person, 'product' => $product]);
        $personProductLikeRepository->remove($personProductLike);

        $this->addFlash('success', "Pomyślnie usunięto polubienie");

        return $this->redirectToRoute('like_list');
    }
}