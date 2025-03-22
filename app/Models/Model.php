<?php

namespace app\Models;

use app\Core\Database;

class Model
{
    protected $conn;
    protected $table;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // get all records in the table
    public function getAll($fields = [])
    {
        $columns = empty($fields) ? "*" : implode(", ", $fields);
        $sql = "SELECT {$columns} FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // create a record in specified table 
    public function create($data)
    {
        // sanitize input (Refactor if storing HTML tags is needed)
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = htmlspecialchars(strip_tags(trim($value)));
            }
        }

        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(array_values($data));
    }

    // get record by id
    public function findById($id, $fields = [])
    {
        $columns = empty($fields) ? "*" : implode(", ", $fields);
        $sql = "SELECT {$columns} FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // update record by id
    public function update($id, $data)
    {
        // sanitize input (Refactor if storing HTML tags is needed)
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = htmlspecialchars(strip_tags(trim($value)));
            }
        }

        $columns = array_keys($data);
        $setClause = implode(", ", array_map(fn($col) => "$col = ?", $columns));

        $sql = "UPDATE {$this->table} SET {$setClause} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute(array_merge(array_values($data), [$id]));
    }

    // delete record by id
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
