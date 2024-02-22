<?php

namespace App\Models;

use App\Models\Database;

use mysqli;

abstract class BaseModel implements CrudInterface
{
    protected $table;
    protected $connection;
    protected $query;

    public function __construct()
    {

        $this->connection = new Database();
    }

    public function getAll()
    {
        $this->query = "SELECT * FROM $this->table";
        $result = $this->connection->query($this->query);
        return $result->fetch_assoc();

    }

    public function orderBy(string $column, string $order = 'ASC')
    {
        $this->query .= " ORDER BY $column $order";
        $result = $this->connection->query($this->query);
        return $result->fetch_assoc();
    }

    public function limit(int $limit = 10)
    {
        $this->query .= " LIMIT $limit";
        return $this;
    }

    public function get()
    {
        $result = $this->connection->query($this->query);
        $data = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function getOne(int $id)
    {
        $this->query = "SELECT * FROM $this->table WHERE id = $id";
        $result = $this->connection->query($this->query);
        return $result->fetch_assoc();
    }

    public function create(array $data)
    {
        // Implement logic to insert data into the database
        //insert table name -> value
    }

    public function update(int $id, array $data)
    {
        // Implement logic to update data in the database
    }

    public function remove(int $id): bool
    {
        // Implement logic to delete data from the database
        return true;
    }
}
