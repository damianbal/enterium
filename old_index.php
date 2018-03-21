<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Enterium</title>
  </head>
  <body>
  <div class="container">
  <div class="row">
  <div class="col">
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

/*
User::create(['username' => 'nowy', 'password' => 'bla']);

foreach($users as $u) {
    $u->username = 'kupas';
    $u->save();
}*/

//$latest_user = User::builder()->order(['id'], 'DESC')->limit(1)->first();
$latest_user = User::latest();


echo "<div>Latest user is: " . $latest_user->username . " :) </div>";

foreach($users as $u) {
    echo "<div>#" . $u->id . " -> " . $u->username . "<a href='index.php?p=delete&id=$u->id' class='btn btn-sm btn-danger'>Remove</a></div>";
}

if($_GET['p'] == 'create')
{
    $u = User::create(['username' => $_GET['un'], 'password' => $_GET['pw']]);

    echo "<div class='alert alert-primary'>Created: " . $u->username . " and password " . $u->password . "!</div>";
}

if($_GET['p'] == 'delete')
{
    $id = $_GET['id'];

    $u = User::find($id);
    $u->delete();
    echo "Deleted #" . $id . "!";
}
?>
</div>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>