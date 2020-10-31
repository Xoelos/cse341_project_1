<?php

class Database
{
    public string $table;
    public PDO $db;
    public array $fields = ['*'];
    public string $sql = '';
    public array $params = Array();

    function __construct(string $table)
    {
        $this->table = $table;
        $this->db = dbConnect();
    }

    function statement(string $statement) {
        $this->sql .= " $statement ";
        return $this;
    }

    function where(string $i, string $eval, $j, bool $wild = false, bool $lower = false) {
        if ($lower)
            $this->sql .= " WHERE LOWER($i) $eval LOWER(?)";
        else
           $this->sql .= " WHERE $i $eval ?";

        if ($wild)
            array_push($this->params, "%$j%");
        else
            array_push($this->params, $j);

        return $this;
    }

    function join(string $t2, string $t2_value, $t1_value) {
        $this->sql .= " JOIN $t2 ON $t2.$t2_value = $this->table.$t1_value";
        return $this;
    }

    function pushToParams($param, bool $wild = false) {
        if($wild)
            array_push($this->params, "%$param%");
        else
            array_push($this->params, $param);
        return $this;
    }
}