<?php

namespace damianbal\enterium;

use damianbal\enterium\QueryBuilder;
use damianbal\enterium\Entity;

class EntityQueryBuilder extends QueryBuilder
{
    public $entity_class = null;

    /**
     * Create entity query builder out of table and class
     *
     * @param [type] $table
     * @param [type] $class
     * @return void
     */
    public function create($table, $class)
    {
        $this->entity_class = $class;
        $this->table = $table;
    }

    /**
     * Returns entities array
     *
     * @param array $data
     * @return array
     */
    public function get($data = [])
    {
        $res = parent::get($data);

        $entities = [];

        foreach($res as $r)
        {
            $entities[] = Entity::convertObjToEntity($this->entity_class, $r);
        }

        return $entities;
    }

    /**
     * Return first record
     *
     * @param array $data
     * @return mixed
     */
    public function first($data = [])
    {
        return $this->get($data)[0];
    }
}
