<?php


class UserQuery extends Query
{
    function queryByEmailAndPassword($email, $hashedPassword) {
        $sql = "SELECT $this->fields FROM $this->table WHERE email = :email AND password = :password";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}