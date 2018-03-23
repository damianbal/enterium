<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;


class Address extends Entity 
{
    protected static $table = 'adresses';

    protected static $attributes    = ['street', 'country', 'user_id'];

}