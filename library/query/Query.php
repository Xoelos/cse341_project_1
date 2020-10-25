<?php

class Query extends Database
{
    function queryAll()
    {
        $sql = "SELECT $this->fields FROM $this->table";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryOne($id)
    {
        $sql = "SELECT $this->fields FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $result;
    }

    function queryByColumn($query, $column)
    {
        $sql = "SELECT $this->fields FROM $this->table WHERE LOWER($column) LIKE LOWER(:query)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryOneByColumn($query, $column)
    {
        $sql = "SELECT $this->fields FROM $this->table WHERE LOWER($column) LIKE LOWER(:query)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}