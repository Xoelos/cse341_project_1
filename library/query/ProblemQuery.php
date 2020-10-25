<?php

class ProblemQuery extends Query
{
    function queryAllProblems()
    {
        $sql = "SELECT problems.id, problems.created_by, problems.name, problems.summary, subjects.name AS subject
                FROM problems 
                JOIN subjects 
                ON subjects.id = problems.subject_id";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryByTerm($searchTerm)
    {
        $sql = "SELECT problems.id, problems.created_by, problems.name, problems.summary, subjects.name AS subject
                FROM problems 
                JOIN subjects 
                ON subjects.id = problems.subject_id
                WHERE LOWER(problems.name)
                LIKE LOWER(:searchTerm) 
                OR problems.summary LIKE LOWER(:searchTerm)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryBySubject($subject)
    {
        $sql = "SELECT problems.id, problems.created_by, problems.name, problems.summary, subjects.name AS subject
                FROM problems 
                JOIN subjects 
                ON subjects.id = problems.subject_id
                WHERE LOWER(subjects.name)
                LIKE LOWER(:subject)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':subject', '%' . $subject . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }

    function queryByTermAndSubject($searchTerm, $subject)
    {
        $sql = "SELECT problems.id, problems.created_by, problems.name, problems.summary, subjects.name AS subject
                FROM problems 
                JOIN subjects 
                ON subjects.id = problems.subject_id
                WHERE (
                    LOWER(problems.name) LIKE LOWER(:searchTerm) 
                    OR LOWER(problems.summary) LIKE LOWER(:searchTerm)
                ) 
                AND LOWER(subjects.name) LIKE LOWER(:subject)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $stmt->bindValue(':subject', '%' . $subject . '%', PDO::PARAM_STR);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $results;
    }
}