<?php

namespace App\Models;

use Core\Database;

class UserModel extends BaseModel {

    public function __construct(Database $database) {
        $this->db = $database;
        $this->setTableName();
        $this->createTableUsers($this->db);
    }
    
    protected function setTableName(): void {
        $this->tableName = 'users';
    }

    public function insertUser($name, $email) {
        $sql = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $this->db->query($sql, ['name' => $name, 'email' => $email]);
    }

    public function getUsers() {
        $sql = "SELECT * FROM users";
        return $this->db->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    public function createTableUsers() {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL UNIQUE
                )";
        $this->db->query($sql);
    }
    
}

