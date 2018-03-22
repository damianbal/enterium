<?php

include 'vendor/autoload.php';

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\Entity;
use damianbal\enterium\entities\User;

DB::getInstance()->connect('enterium');

$user = User::find( $_GET['id'] ?? 13 );

$adresy = $user->hasMany(\damianbal\enterium\entities\Address::class, 'user_id')->get();

$users_total = User::builder()->count();

echo "Total users: " . $users_total;

echo $user->username . " posiada takie adresy: <br>";

foreach($adresy as $adres) {
    echo $adres->street . "<br>";
}

$address = \damianbal\enterium\entities\Address::find(2);
echo $address->belongsTo(User::class, 'user_id')->first()->username;
