<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;

class User extends Entity 
{
    protected static $table = 'users';

    public $username = "Username";
    public $password = "Password";

    public function wypisz()
    {
        return "To jest " . $this->username . " ma haslo " . $this->password . " :D";
    }

    public function czyJestAdminem()
    {
        if($this->password == 'damian1') return true;

        return false;
    }

    protected static $props = [
        'username' => 'varchar(255)',
        'password' => 'varchar(300)'
    ];
}