<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use damianbal\enterium\DB;
use damianbal\enterium\entities\User;

final class EntityTest extends TestCase 
{
    protected $db = 'enterium';

    // test if creating users work
    public function testCreateEntity()
    {
        DB::getInstance()->connect($this->db);

        $e = \damianbal\enterium\entities\User::create(['username' => 'test', 'password' => 'too']);

        echo $e->id;
        //$this->assertGreaterThan($e->id, 1);
        $this->assertNotNull($e->id);

        $e->delete();
    }

    // tests if updating users works
    public function testUpdateEntity()
    {
        DB::getInstance()->connect($this->db);

        $user = User::create(['username' => 'testing', 'password' => '...']);
        $user_id = $user->id;

        $user->username = 'updated_user';
        $user->save();

        $user1 = User::find($user_id);
        
        $this->assertEquals($user1->username, 'updated_user');
        $user->delete();
    }
}