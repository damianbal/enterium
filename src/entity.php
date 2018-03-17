<?php

namespace damianbal\enterium;

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\EntityQueryBuilder;

class Entity
{
    protected static $table    = '';
    protected static $props = [];
    public $id       = null;

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
}