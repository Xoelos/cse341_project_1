<?php

class Problem
{
    private ?string $name = null;
    private ?string $subject = null;
    private ?string $summary = null;

    public function __construct($name, $subject, $summary)
    {
        if ($name)
            $this->name = $name;
        if ($subject)
            $this->subject = $subject;
        if ($summary)
            $this->summary = $summary;
    }

    function queryProblems()
    {
        $problemsQuery = new ProblemQuery('problems', '*', 'subjects', 'name');

        if ($this->name && $this->subject) {
            return $problemsQuery->queryByTermAndSubject($this->name, $this->subject);
        } else if ($this->name) {
            return $problemsQuery->queryByTerm($this->name);
        } else if ($this->subject) {
            return $problemsQuery->queryBySubject($this->subject);
        } else {
            return $problemsQuery->queryAllProblems();
        }
    }

    function queryByUserId($id) {
        $problemsQuery = new ProblemQuery('problems', '*', 'subjects', 'name');
        return $problemsQuery->queryByUserId($id, 'created_by');
    }

    function create() {
        $create = new Create('problems', 'id, created_by, name, subject_id, summary');
        return $create->createRecord(array($_SESSION['logged'], $this->name, $this->subject, $this->summary));
    }

    function update() {
        $update = new Update('problems');
        return $update->updateById($_SESSION['logged'], array("name" => $this->name, "subject_id" => $this->subject, "summary" => $this->summary));
    }

    function delete($id) {
        $delete = new Delete('problems');
        return $delete->deleteById($id);
    }
}

