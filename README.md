## Enterium
Enterium is simple PHP library to make working with Database very easy.

Look at this example, that line of code will return all users 

    $users = User::builder()->get();

but if you want just one user you can do that

    $user = new User(1);
then you can delete that user 

    $user->delete();