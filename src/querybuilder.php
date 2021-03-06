<?php

namespace damianbal\enterium;

use damianbal\enterium\DB;

class QueryBuilder
{
    protected $query = "";
    protected $table = "";
    protected $values = [];

    public function __construct() {}

    /**
     * Create and return new QueryBuilder instance
     *
     * @param string $table
     * @return void
     */
    public static function builder($table) 
    {
        $queryBuilder = new QueryBuilder();
        $queryBuilder->table = $table;
        return $queryBuilder;
    }

    /**
     * Insert values into table
     *
     * @param [type] $values
     * @return void
     */
    public function insert($values)
    {
        $columns = [];
        $values1 = [];
        
        foreach($values as $key => $val)
        {
            $columns[] = $key;
            $values1[] = ':'.$key;
            $this->values[':'.$key] = $val;
        }

        $cols = implode(',', $columns);
        $vals = implode(',',$values1);

        $this->query = "INSERT INTO $this->table ($cols) VALUES ($vals)";
    
        //echo $this->query;
        //var_dump($this->values);

        return $this;
    }

    /**
     * Order by
     *
     * @param array $columns
     * @param string $order
     * @return QueryBuilder
     */
    public function order($columns, $order = 'ASC')
    {
        $cols = implode(',', $columns);

        $this->query .= "ORDER BY $cols $order ";

        return $this;
    }

    /**
     * Select columns
     *
     * @param string $columns
     * @return QueryBuilder
     */
    public function select($columns = '*') : QueryBuilder
    {
        if($columns != '*')
        {
            $cols = implode(',', $columns);
        }
        else {
            $cols = '*';
        }

        $this->query .= "SELECT " . $cols . " FROM " . $this->table . " ";

        return $this;
    }

    /**
     * Where clause
     *
     * @param string $column
     * @param string|integer|bool $value
     * @param string $operator
     * @return QueryBuilder
     */
    public function where($column, $value, $operator = '=')
    {
        $column_id = ':'.$column;
        $this->values[$column_id] = $value;

        $q = "WHERE $column $operator $column_id ";

        $this->query .= $q;

        return $this;
    }

    /**
     * Where and
     *
     * @param string $column
     * @param string|integer|bool $value
     * @param string $operator
     * @return QueryBuilder
     */
    public function andWhere($column, $value, $operator = '=')
    {
        $column_id = ':'.$column;
        $this->values[$column_id] = $value;

        $q = "AND $column $operator $column_id ";

        $this->query .= $q;

        return $this;
    }

    /**
     * Where or
     *
     * @param string $column
     * @param string|integer|bool $value
     * @param string $operator
     * @return QueryBuilder
     */
    public function orWhere($column, $value, $operator = '=')
    {
        $column_id = ':'.$column;
        $this->values[$column_id] = $value;

        $q = "OR $column $operator $column_id ";

        $this->query .= $q;

        return $this;
    }

    /**
     * Limit
     *
     * @param [integer] $l
     * @param [integer] $count
     * @return damianbal\enterium\QueryBuilder
     */
    public function limit($l, $count = null)
    {
        if($count == null)
            $q = "LIMIT $l ";
        else 
            $q = "LIMIT $l,$count ";

        $this->query .= $q;

        return $this;
    }

    /**
     * GROUP BY
     *
     * @param string $column
     * @param string $type
     * @return damianbal\enterium\QueryBuilder
     */
    public function group($column, $sort = 'ASC')
    {
        $this->query .= "GROUP BY $column $type ";
        return $this;
    }

    /**
     * Returns generated query
     *
     * @return string
     */
    public function getQuery() : string 
    {
        $trimmed_query = rtrim($this->query, ' ');
        return $trimmed_query;
    }

    /**
     * Execute query and return results
     *
     * @param array $data
     * @return array
     */
    public function get($data = [])
    {
        $new_data = array_merge($data, $this->values);

        return DB::getInstance()->execute($this->getQuery(), $new_data);
    }

    /**
     * Return query as json
     *
     * @param array $data
     * @return mixed
     */
    public function json($data = [])
    {
        return json_encode($this->get());
    }

    /**
     * 
     *
     * @param array $data
     * @return mixed
     */
    public function first($data = [])
    {
        $d = $this->get($data);
        return $d[0];
    }

    /**
     * Number of results
     *
     * @return integer|int
     */
    public function count()
    {
        return count( $this->get() );
    }
}