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
    }

    public function connect($dbname, $host = '127.0.0.1', $user = 'root', $pass = '', $driver = 'mysql')
    {
        $this->pdo = new \PDO("$driver:host=$host;dbname=$dbname", $user, $pass, [
            \PDO::ATTR_EMULATE_PREPARES => false,
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ]);

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

    /**
     * Execute .sql file. Useful for creating tables. Simply export your database into ".sql" and then run it with that method.
     *
     * @param string $file
     * @return void
     */
    public function run($file)
    {
        $sql = file_get_contents($file);

        $this->execute($sql);
    }
}