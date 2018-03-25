<?php

namespace damianbal\enterium;

use damianbal\enterium\DB;
use damianbal\enterium\QueryBuilder;
use damianbal\enterium\EntityQueryBuilder;
use damianbal\enterium\EntityHelpers;
use damianbal\enterium\EntityRelations;

class Entity
{
    use EntityHelpers, EntityRelations;
    
    protected static $table    = '';
    protected static $attributes    = [];
    protected        $values   = [];
    protected        $created  = false;

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
    public function __construct()
    {
        $this->id = null;
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
     * QueryBuilder which returns standard php object when get() is called.
     * Useful for returing json
     *
     * @return void
     */
    public static function queryBuilder()
    {
        if(!empty(static::$visible))
        {
            return QueryBuilder::builder(static::$table)->select(static::$visible);
        }

        return QueryBuilder::builder(static::$table)->select();
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

        foreach(array_merge($entity_class::$attributes,['id']) as $key)
        {
            $entity->{$key} = $obj->{$key};
        }

        return $entity;
    }

    /**
     * Convert entity into array
     *
     * @param [type] $entity_class
     * @param [type] $entity
     * @return void
     */
    public static function convertEntityToArray($entity_class, $entity)
    {
        $arr = [];

        foreach(array_merge($entity_class::$attributes,['id']) as $key)
        {
            $arr[$key]= $entity->{$key};
        }

        return $arr;
    }

    /**
     * Update entity
     *
     * @return void
     */
    public function save() : void
    {
        if($this->created == false)
        {
            $q = "UPDATE " . static::$table . " SET ";

            $vals = [];
            $qs   = [];

            foreach($this->values as $key => $value) {
                if($key != 'id')
                {
                    $qx = $key . " = :" . $key;
                    $qs[] = $qx;
                    $vals[':' . $key] = $value;
                }
            }

            $q .= implode(',',$qs);

            $q .= " WHERE id = :id";

            $vals[':id'] = $this->id;

            DB::getInstance()->execute($q, $vals);
        }
        else 
        {
            // 
            static::builder()->insert($this->values);
        }
    }

    /**
     * Create entity
     *
     * @param array $vals
     * @return mixed
     */
    public static function create($vals = [])
    {
        $p = static::builder()->insert($vals)->get();

        // gets last element from table which is one we just inserted
        $l = static::builder()->order(['id'], 'DESC')->limit(1)->get();

        return $l[0];
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