<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;


class User extends Entity 
{
    protected static $table = 'users';
    protected static $attributes    = ['username', 'password'];

}