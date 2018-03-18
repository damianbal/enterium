<?php

namespace damianbal\enterium;

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\EntityQueryBuilder;
use damianbal\enterium\Relations;

class Entity
{
    protected static $table    = '';
    protected static $props    = [];
    protected        $values   = [];

    /**
     * Set property
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->values[$name] = $value;
    }

    /**
     * Return property
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->values[$name];
    }

    /**
     * Create or load existing entity
     *
     * @param [type] $id
     */
    public function __construct( $id = null )
    {
        if($id == null) 
        {
            echo "Creating";
        }
        else {
            echo "Loading";
        }
    }

    /**
     * Returns instance of EntityQueryBuilder
     *
     * @return damianbal\enterium\EntityQueryBuilder
     */
    public static function builder()
    {
        $entityQueryBuilder = new EntityQueryBuilder;
  
        $entityQueryBuilder->create(static::$table, static::class);

        return $entityQueryBuilder->select();
    }

    /**
     * Converts stdClass to Entity dervided class
     *
     * @param class $entity_class
     * @param stdClass $obj
     * @return array
     */
    public static function convertObjToEntity($entity_class, $obj)
    {
        $entity = new $entity_class;

        foreach(array_merge($entity_class::$props, ['id' => 'primary']) as $key => $value)
        {
            $entity->{$key} = $obj->{$key};
        }

        return $entity;
    }

    /**
     * Delete entity 
     *
     * @return void
     */
    public function delete() : void
    {
        $q = "DELETE FROM " . static::$table . " WHERE id = :id";

        DB::getInstance()->execute($q, [':id' => $this->id]);
    }
}