<?php

namespace Core;

use \PDO;
use \PDOException;


class Database {
    private $pdo;

    public function __construct($config) {
        try {
            $this->pdo = new PDO($config['dsn']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
    
        // Expose la méthode prepare de PDO
    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
    
        // Expose la méthode beginTransaction de PDO
    public function beginTransaction() {
        return $this->pdo->beginTransaction();
    }

    // Expose la méthode commit de PDO
    public function commit() {
        return $this->pdo->commit();
    }

    // Expose la méthode rollBack de PDO
    public function rollBack() {
        return $this->pdo->rollBack();
    }

}

