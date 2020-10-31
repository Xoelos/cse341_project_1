<?php

class Category
{
    private string $name;

    function set($name)
    {
        $this->name = $name;
    }

    static function queryAll()
    {
      $query = new Query('categories');
      return $query->fields(['*'])->getAll();
    }
}