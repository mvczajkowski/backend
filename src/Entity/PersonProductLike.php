<?php

namespace App\Entity;

use App\Repository\PersonProductLikeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonProductLikeRepository::class)
 */
class PersonProductLike
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Person", inversedBy="person_product_likes")
     * @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     */
    private Person $person;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="person_product_likes")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private Product $product;


    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
