<?php

class Query
{
    public string $table;
    public string $fields;

    function __construct($table, $fields = "*")
    {
        $this->table = $table;
        $this->fields = $fields;
    }

    function queryAll()
    {
        $db = dbConnect();
        $sql = "SELECT $this->fields FROM $this->table";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryOne($id)
    {
        $db = dbConnect();
        $sql = "SELECT $this->fields FROM $this->table WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return array($result);
    }

    function queryByColumn($query, $column)
    {
        $db = dbConnect();
        $sql = "SELECT $this->fields FROM $this->table WHERE LOWER($column) LIKE LOWER(:query)";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryByColumns($query, $columns)
    {
        $db = dbConnect();

        $sql = "SELECT $this->fields FROM $this->table WHERE";
        foreach ($columns as $index => $column) {
            if ($index == (count($columns) - 1))
                $sql .= " LOWER($column) LIKE LOWER(:query)";
            else
                $sql .= " LOWER($column) LIKE LOWER(:query) OR";
        }

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryByColumnsWithValues($query, $columns, $query_2, $columns_2)
    {
        $db = dbConnect();

        $sql = "SELECT $this->fields FROM $this->table WHERE (";
        foreach ($columns as $index => $column) {
            if ($index == (count($columns) - 1))
                $sql .= " LOWER($column) LIKE LOWER(:query)";
            else
                $sql .= " LOWER($column) LIKE LOWER(:query) OR";
        }

        $sql .= ") AND (LOWER($columns_2) LIKE LOWER(:query_2))";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
        $stmt->bindValue(':query_2', '%' . $query_2 . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}