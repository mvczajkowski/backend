<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=PersonRepository::class)
 */
class Person
{
    const STATE_ACTIVE = 1;
    const STATE_BANNED = 2;
    const STATE_DELETED = 3;

    const READABLE_STATES = [
        1 => "Aktywny",
        2 => "Zbanowany",
        3 => "Usunięty"
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $login;

    /**
     * @ORM\Column(name="l_name", type="string", length=100)
     */
    private $lName;

    /**
     * @ORM\Column(name="f_name", type="string", length=100)
     */
    private $fName;

    /**
     * @ORM\Column(type="smallint")
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity="PersonProductLike", mappedBy="person")
     */
    private $personProductLikes;

    public function __construct() {
        $this->personProductLikes = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;

        return $this;
    }

    public function getLName(): string
    {
        return $this->lName;
    }

    public function setLName(string $lName): self
    {
        $this->lName = $lName;

        return $this;
    }

    public function getFName(): string
    {
        return $this->fName;
    }

    public function setFName(string $fName): self
    {
        $this->fName = $fName;

        return $this;
    }

    public function getState(): int
    {
        return $this->state;
    }

    public function getReadableState(): string
    {
        return self::READABLE_STATES[$this->state];
    }

    public function setState(int $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPersonProductLikes(): ArrayCollection
    {
        return $this->personProductLikes;
    }
}
