<?php

class Query extends Database
{
    public function __construct(string $table)
    {
        parent::__construct($table);
    }

    function fields(array $fields) {
        $this->fields = $fields;
        $this->sql .= "SELECT ";

        foreach ($fields as $field){
            $this->sql .= "$field,";
        }

        $this->sql = rtrim($this->sql, ",");
        $this->sql .= " FROM $this->table";

        return $this;
    }

    function get() {
        $stmt = $this->db->prepare($this->sql);
        foreach ($this->params as $index => $param) {
            $stmt->bindValue($index + 1, $param);
        }
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function getAll() {
        $stmt = $this->db->prepare($this->sql);

        foreach ($this->params as $index => $param) {
            $stmt->bindValue($index + 1, $param);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}