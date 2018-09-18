<?php

class Database
{
    private $db = NULL;

    private function getConnection()
    {
      //  require_once 'Connect.php';
        try {
            $pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
            return $pdo;
        } catch (Exception $error) {
            return NULL;
        }
    }

    public function __construct() {
        $this->db = $this->getConnection();
        if (!isset($this->db)) {
            die('Нет подключения к базе данных');
        }
    }

    public function doRequest($request, $params)
    {
        $results = [];
        $stmt = NULL;
        try {
            $this->db = $this->getConnection();
            $stmt = $this->db->prepare($request);
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->execute();
            $this->db = NULL;
            if (isset($stmt)) {
                while ($row = $stmt->fetch()) {
                    $results[] = $row;
                }
            } else {
                $results = NULL;
            }
        } catch (Exception $error) {
            echo $error->getMessage();
        }
        return $results;
    }

}
