<?php

class Create extends Database
{
    public array $values = [];

    function __construct(string $table)
    {
        parent::__construct($table);
        $this->sql .= "INSERT INTO $table (";
    }

    function values(array $values)
    {
        $this->values = $values;
        return $this;
    }

    function insert() {
        foreach ($this->values as $column => $value) {
            $this->sql .= "$column, ";
        }

        $this->sql = rtrim($this->sql, ', ');
        $this->sql .= ") VALUES (";

        foreach ($this->values as $column => $value) {
            $this->sql .= "?, ";
        }

        $this->sql = rtrim($this->sql, ', ');
        $this->sql .= ")";

        $stmt = $this->db->prepare($this->sql);

        $i = 1;
        foreach ($this->values as $index => $value) {
            $stmt->bindValue($i, $value);
            $i++;
        }

        $stmt->execute();
        $results = $this->db->lastInsertId();
        $stmt->closeCursor();
        return $results;
    }
}