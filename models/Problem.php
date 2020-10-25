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
        require '../library/classes.php';

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

    function create() {
        $newProblem = new Create('problems', 'id, created_by, name, subject, summary');
        return $newProblem->createRecord($_SESSION['logged'], $this->name, $this->subject, $this->summary);
    }
}

