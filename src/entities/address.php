<?php 

namespace damianbal\enterium\entities;

use damianbal\enterium\Entity;

class Address extends Entity 
{
    protected static $table = 'adresses';

    public function wypisz_caly_adres()
    {
        return "<div>Street: $this->street, Country: $this->country</div>";
    }

    protected static $props = [
        'id' => 'primary',
        'street' => 'varchar(255)',
        'country' => 'varchar(300)',
        'user_id' => ''
    ];
}