<?php

namespace App\Model;

class PersonFilter
{
    // const STATE_ACTIVE = 1;
    // const STATE_BANNED = 2;
    // const STATE_DELETED = 3;

    // const READABLE_STATES = [
    //     1 => "Aktywny",
    //     2 => "Zbanowany",
    //     3 => "Usunięty"
    // ];

    private string $login = "";
    
    private string $lName = "";

    private string $fName = "";

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
}