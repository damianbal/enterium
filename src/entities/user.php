<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;

// TODO: cleanup
class User extends Entity 
{
    protected static $table = 'users';

    protected static $props = [
        'username' => 'varchar(255)',
        'password' => 'varchar(300)',
        'id' => ''
    ];
}