<?php

class Database
{
    public string $table;
    public string $fields;
    public ?string $join_table;
    public ?string $join_fields;
    public PDO $db;

    function __construct($table, $fields = "*", $join_table = null, $join_fields = null)
    {
        $this->table = $table;
        $this->fields = $fields;
        $this->join_table = $join_table;
        $this->join_fields = $join_fields;
        $this->db = dbConnect();
    }

}