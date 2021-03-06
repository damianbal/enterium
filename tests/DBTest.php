<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use damianbal\enterium\DB;

final class DBTest extends TestCase 
{
    // will check connection to db and if singleton is created
    public function testDBSingletonCreated() {
        DB::getInstance()->connect('enterium');
        $this->assertInstanceOf(DB::class, DB::getInstance());
    
    }
}