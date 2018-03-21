<?php

include 'vendor/autoload.php';

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\Entity;
use damianbal\enterium\entities\User;

DB::getInstance()->connect('enterium');

$user = User::find( $_GET['id'] ?? 13 );

$adresy = $user->hasMany(\damianbal\enterium\entities\Address::class, 'user_id')->get();

echo $user->username . " posiada takie adresy: <br>";

foreach($adresy as $adres) {
    echo $adres->wypisz_caly_adres();
}
//var_dump($adres);
//var_dump($user);