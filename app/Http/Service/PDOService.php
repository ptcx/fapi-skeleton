<?php

namespace App\Http\Service;

class PDOService
{
    private $dsn;
    private $username;
    private $password;

    public function __construct($dbConfig)
    {
        $driver = $dbConfig['driver'];
        $host = isset($dbConfig['host']) ? $dbConfig['host'] : 'localhost';
        $port = isset($dbConfig['port']) ? $dbConfig['port'] : '3306';
        $dbName = $dbConfig['dbname'];
        $charset = isset($dbConfig['charset']) ? $dbConfig['charset'] : 'utf8';

        $this->username = $dbConfig['username'];
        $this->password = $dbConfig['password'];
        $this->dsn = sprintf("%s:host=%s;port=%s;dbname=%s;charset=%s",
            $driver, $host, $port, $dbName, $charset);
    }

    /**
     * 获取对应的pdo对象
     * @param array $options
     * @return \PDO
     */
    public function getDBHandler($options=[])
    {
        if (empty($options)) {
            $options = [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ];
        }

        return new \PDO($this->dsn, $this->username, $this->password, $options);
    }

}