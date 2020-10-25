<?php

class Create extends Database
{
    function createRecord($values)
    {
        $sql = "INSERT INTO $this->table ($this->fields) VALUES (DEFAULT, ";
        foreach ($values as $index=>$value) {
            if ($index == sizeof($values) - 1){
                $sql .= '?';
            } else {
                $sql .= '?, ';
            }
        }
        $sql .= ")";

        $stmt = $this->db->prepare($sql);

        foreach ($values as $index=>$value) {
            $stmt->bindValue($index + 1, $value);
        }

        $stmt->execute();
        $results = $this->db->lastInsertId();
        $stmt->closeCursor();
        return $results;
    }
}