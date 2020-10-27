<?php


class Delete extends Database
{
    function deleteById($id) {
        $sql = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->rowCount(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}