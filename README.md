
[![Packagist](https://img.shields.io/packagist/v/symfony/symfony.svg)](https://github.com/damianbal/enterium) [![PHP from Packagist](https://img.shields.io/packagist/php-v/symfony/symfony.svg)](https://github.com/damianbal/enterium)


## Enterium
Enterium is simple PHP library to make working with Database very easy.

Look at this example, that line of code will return all users 

    $users = User::builder()->get();

but if you want just one user you can do that

    $user = User::find(1);
    
then you can delete that user 

    $user->delete();

if you would like to get users which are admins you would do

     $admin_users = User::builder()->where('is_admin', true)->get();

to create user simply do

    $new_user = User::create(['username' => 'new_user', 'password' => 'somepass']);
    $new_user->password = 'updated_password';
    $new_user->save(); // update user

has many relation is simply

    $user->hasMany(Address::class, 'user_id')->get();

but it can be implemented inside User entity class with $this->hasMany :)

Also if you want to just make your own queries without Entities then you can do that to.

    QueryBuilder::builder()->select()->where('id', 3, '>')->get();

that line above will return all users with id over 3, then you can access properties using -> syntax :) 
