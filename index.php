<?php 

include 'vendor/autoload.php';

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\Entity;
use damianbal\enterium\entities\User;

DB::getInstance()->connect('enterium');

$users = User::builder()->order(['id'],'DESC')->limit(1)->get();

foreach($users as $user)
{
    echo "<div>" . $user->wypisz() . "</div>";
}