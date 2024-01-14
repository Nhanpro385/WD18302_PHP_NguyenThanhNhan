<?php

namespace App\Model;

abstract class BaseModel implements CrudInterface {
    protected $table;

    public function __construct($table) {
        $this->table = $table;
    }

    public function create(array $data) {
        // Implement logic to create a record in the database
    }

    public function read($id) {
        // Implement logic to retrieve a record from the database based on ID
    }

    public function update($id, array $data) {
        // Implement logic to update a record in the database based on ID
    }

    public function delete($id) {
        // Implement logic to delete a record from the database based on ID
    }
}
