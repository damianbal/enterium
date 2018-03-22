<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;

class Address extends Entity 
{
    protected static $table = 'adresses';


    protected static $props = [
        'id' => 'primary',
        'street' => 'varchar(255)',
        'country' => 'varchar(300)',
        'user_id' => ''
    ];
}