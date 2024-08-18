<?php

namespace App\Models;

use Core\Database;
use PDO;

abstract class BaseModel {
    protected $db;
    protected $tableName;
    protected $primaryKey = 'id';

    public function __construct(Database $database) {
        $this->db = $database;
        $this->setTableName();
    }

    // Méthode abstraite pour définir le nom de la table dans les classes enfants
    abstract protected function setTableName(): void;

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM {$this->tableName}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array {
        $stmt = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE {$this->primaryKey} = :id");
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null;
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Gestion des transactions
    public function startTransaction(): void {
        $this->db->beginTransaction();
    }

    public function commit(): void {
        $this->db->commit();
    }

    public function rollback(): void {
        $this->db->rollBack();
    }

    // D'autres méthodes communes peuvent être ajoutées ici
}

