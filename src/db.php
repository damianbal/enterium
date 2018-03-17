<?php

namespace damianbal\enterium;

class DB 
{
    protected $pdo;
    private static $instance = null;

    /**
     * Return instance
     *
     * @return damianbal\enterium\DB
     */
    public static function getInstance()
    {
        if(static::$instance == null) {
            static::$instance = new DB();
        }

        return static::$instance;
    }

    /**
     * Create database connection
     */
    private function __construct() 
    {
        /*$this->pdo = new \PDO("mysql:host=127.0.0.1;dbname=enterium", "root", "", array(\PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)); */

        // $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
    }

    public function connect($dbname, $host = '127.0.0.1', $user = 'root', $pass = '', $driver = 'mysql')
    {
        $this->pdo = new \PDO("$driver:host=$host;dbname=$dbname", $user, $pass, array(\PDO::ATTR_EMULATE_PREPARES => false,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));

        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
    }

    /**
     * Execute query and return results
     *
     * @param string $query
     * @param array $data
     * @return array
     */
    public function execute($query, $data = []) 
    {
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
        return $stmt->fetchAll(\PDO::FETCH_OBJ);

    }

    /**
     * Execute query and result assoc array
     *
     * @param string $query
     * @param array $data
     * @return array
     */
    public function execute_assoc($query, $data = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}