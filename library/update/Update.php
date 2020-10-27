<?php


class Update extends Database
{
    function updateById($id, $data) {
        $sql = "UPDATE $this->table SET ";
        $i = 0;
        $length = count($data);

        foreach ($data as $column=>$updateValue) {
            $sql .= "$column = :$column";
            if ($i !== $length - 1)
                $sql .= ", ";
            $i++;
        }
        $sql .= " WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        foreach ($data as $column=>$updateValue) {
            $stmt->bindValue(":$column", $updateValue, PDO::PARAM_STR);
        }

        $stmt->execute();
        $results = $stmt->rowCount(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}