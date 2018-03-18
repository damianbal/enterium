<?php

include 'vendor/autoload.php';

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\Entity;
use damianbal\enterium\entities\User;

DB::getInstance()->connect('enterium');


/*
$users = User::builder()->order(['id'],'DESC')->limit(1,0)->get();

echo $users[0]->username;
*/

///User::builder()->insert(['username' => 'hello', 'password' => 'mojehaslo'])->get();

$users = User::builder()->get();

User::create(['username' => 'nowy', 'password' => 'bla']);

foreach($users as $u) {
    $u->username = 'kupas';
    $u->save();
}