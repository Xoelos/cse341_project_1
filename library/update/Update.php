<?php


class Update extends Database
{
    function __construct(string $table)
    {
        parent::__construct($table);
        $this->sql .= "UPDATE $this->table SET ";
    }

    function fields(array $fields)
    {
        foreach ($fields as $field) {
            $this->sql .= "$field = ?, ";
        }

        $this->sql = rtrim($this->sql, ', ');
        return $this;
    }

    function update(array $values)
    {
        $stmt = $this->db->prepare($this->sql);
        foreach ($values as $column => $value) {
            $stmt->bindValue($column + 1, $value);
        }

        $stmt->execute();
        $results = $stmt->rowCount();
        $stmt->closeCursor();
        return $results;
    }
}