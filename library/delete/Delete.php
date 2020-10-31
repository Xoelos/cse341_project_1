<?php


class Delete extends Database
{
    function __construct(string $table)
    {
        parent::__construct($table);
        $this->sql = "DELETE FROM $this->table";
    }

    function delete() {
        $stmt = $this->db->prepare($this->sql);

        foreach ($this->params as $index=>$value) {
            $stmt->bindValue($index + 1, $value);
        }

        $stmt->execute();
        $results = $stmt->rowCount();
        $stmt->closeCursor();
        return $results;
    }
}