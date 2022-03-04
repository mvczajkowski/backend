<?php

namespace App\Service;

use App\Entity\Person;
use App\Entity\PersonProductLike;
use App\Entity\Product;
use App\Model\PersonProductLike\PersonProductLikeModel;
use App\Repository\PersonRepository;
use App\Repository\PersonProductLikeRepository;
use App\Repository\ProductRepository;

class LikeService
{
    private PersonRepository $personRepository;
    private ProductRepository $productRepository;
    private PersonProductLikeRepository $likeRepository;

    public function __construct(
        PersonRepository $personRepository,
        ProductRepository $productRepository,
        PersonProductLikeRepository $likeRepository)
    {
        $this->personRepository = $personRepository;
        $this->productRepository = $productRepository;
        $this->likeRepository = $likeRepository;
    }

    public function getPeopleForLikeSelect(string $query): array
    {
        $result = $this->personRepository->findPeopleForLikeSelect($query);

        $response = [];
        foreach ($result as $person) {
            $response[] = [
                'id' => $person->getId(),
                'name' => $person->getFName() . " " . $person->getLName() . " (" . $person->getLogin(). ")"
            ];
        }

        return $response;
    }

    public function getProductsForLikeSelect(string $query): array
    {
        $result = $this->productRepository->findProductsForLikeSelect($query);

        $response = [];
        foreach ($result as $product) {
            $response[] = [
                'id' => $product->getId(),
                'name' => $product->getName()
            ];
        }

        return $response;
    }

    public function createNewLike(PersonProductLikeModel $personProductLikeModel)
    {
        $person = $this->personRepository->find($personProductLikeModel->getPersonId());
        $product = $this->productRepository->find($personProductLikeModel->getProductId());

        $errors = $this->checkIfLikeExists($person, $product);
        if ($errors !== null) {
            return $errors;
        }

        $personProductLike = new PersonProductLike();
        $personProductLike
            ->setPerson($person)
            ->setProduct($product);

        $this->likeRepository->add($personProductLike);

        return ['type' => "success", 'message' => "Pomyślnie dodano polubienie"];
    }

    public function editLike(PersonProductLike $oldPersonProductLike, PersonProductLikeModel $personProductLikeModel)
    {
        $person = $this->personRepository->find($personProductLikeModel->getPersonId());
        $product = $this->productRepository->find($personProductLikeModel->getProductId());

        $errors = $this->checkIfLikeExists($person, $product, $oldPersonProductLike);
        if ($errors !== null) {
            return $errors;
        }

        $personProductLikeModel->getPersonId() !== 0 && $oldPersonProductLike->setPerson($person);
        $personProductLikeModel->getProductId() !== 0 && $oldPersonProductLike->setProduct($product);

        $this->likeRepository->add($oldPersonProductLike);

        return ['type' => "success", 'message' => "Pomyślnie edytowano polubienie"];
    }

    private function checkIfLikeExists(?Person $person, ?Product $product, ?PersonProductLike $oldPersonProductLike = null): ?array
    {
        $person === null && $person = $oldPersonProductLike->getPerson();
        $product === null && $person = $oldPersonProductLike->getProduct();

        $like = $this->likeRepository->findOneBy(['person' => $person, 'product' => $product]);

        if ($like !== null) {
            return [
                'type' => "error",
                'message' => "Takie polubienie już istnieje"
            ];
        }
        return null;
    }
}