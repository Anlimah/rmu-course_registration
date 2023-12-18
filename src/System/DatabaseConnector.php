<?php

namespace Src\System;

class DatabaseConnector
{
    private $conn = null;

    public function __construct($host, $port, $db, $user, $pass)
    {
        try {
            $this->conn = new \PDO("mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db", $user, $pass);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function runQuery($str, $params = array()): mixed
    {
        try {
            $stmt = $this->conn->prepare($str);
            $stmt->execute($params);
            if (explode(' ', $str)[0] == 'SELECT' || explode(' ', $str)[0] == 'CALL') return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            elseif (explode(' ', $str)[0] == 'INSERT' || explode(' ', $str)[0] == 'UPDATE' || explode(' ', $str)[0] == 'DELETE') return 1;
            return 0;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
