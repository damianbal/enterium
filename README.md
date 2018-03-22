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
    