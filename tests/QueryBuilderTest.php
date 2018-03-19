<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;

final class QueryBuilderTest extends TestCase 
{
    protected $db = 'enterium';

    public function connect() {
        DB::getInstance()->connect($this->db);
    }

    public function testSelectAllInTable() {
        // SELECT * FROM table_name

        $q = \damianbal\enterium\QueryBuilder::builder('table_name')->select('*')->getQuery();

        $this->assertEquals($q, "SELECT * FROM table_name");
    }

    public function testSelectColumns() {
        // SELECT id,name FROM table_name
        $q = \damianbal\enterium\QueryBuilder::builder('table_name')->select(['id','name'])->getQuery();

        $this->assertEquals($q, "SELECT id,name FROM table_name");
    }

    public function testLimit() {
        $q = \damianbal\enterium\QueryBuilder::builder('table_name')->select()->limit(1)->getQuery();
        $this->assertEquals($q, "SELECT * FROM table_name LIMIT 1");
    }

    public function testOrderBy() {
        $q = \damianbal\enterium\QueryBuilder::builder('table_name')->select()->order(['id'], 'ASC')->getQuery();
        $this->assertEquals($q, "SELECT * FROM table_name ORDER BY id ASC");
    }
}