<?php

namespace App\Model\PersonProductLike;

class PersonProductLikeModel
{

    private int $personId = 0;
    
    private int $productId = 0;

    public function getPersonId(): int
    {
        return $this->personId;
    }

    public function setPersonId(int $personId): self
    {
        $this->personId = $personId;

        return $this;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }
}