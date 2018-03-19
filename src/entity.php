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
    public function __construct( $id = null, $create = false )
    {
        if($this->create == false)
        {
            $this->id = null;

            if($id == null) 
            {
                echo "Creating";
            }
            else {
                echo "Loading";
            }
        }
        else 
        {
            // get by id
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

            echo "<div>".$q."</div>";

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