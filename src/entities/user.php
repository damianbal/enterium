<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;

class User extends Entity 
{
    protected static $table = 'users';

    protected static $props = [
        'username' => 'varchar(255)',
        'password' => 'varchar(300)',
        'id' => ''
    ];
}