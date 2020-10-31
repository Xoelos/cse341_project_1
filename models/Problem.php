<?php

class Problem
{
    private ?string $id;
    private ?string $name;
    private ?string $category;
    private ?string $summary;

    public function __construct($id = null, $name = null, $category = null, $summary = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->category = $category;
        $this->summary = $summary;
    }

    public static function getByUserId($id)
    {
        $query = new Query('problems');
        return $query->fields([
            'problems.id',
            'problems.created_by',
            'problems.name',
            'problems.summary',
            'categories.name AS category',
            'categories.id AS category_id'])
            ->join('categories', 'id', 'category_id')
            ->where('created_by', '=', $id)
            ->getAll();
    }

    public static function queryProblems($name = null, $category = null)
    {
        $query = new Query('problems');

        $query->fields([
            'problems.id',
            'problems.created_by',
            'problems.name',
            'problems.summary',
            'categories.name AS category'
        ]);

        $query->join('categories', 'id', 'category_id');

        if ($name && $category) {
            return $query->statement(" WHERE ((LOWER(problems.name) LIKE LOWER(?) ")
                ->statement("OR LOWER(problems.summary) LIKE LOWER(?)) ")
                ->statement("AND categories.id = ?)")
                ->pushToParams($name, true)
                ->pushToParams($name, true)
                ->pushToParams($category)
                ->getAll();
        } else if ($name) {
            return $query->statement(' WHERE (LOWER(problems.name) LIKE LOWER(?) OR LOWER(problems.summary) LIKE LOWER(?)) ')
                ->pushToParams($name, true)
                ->pushToParams($name, true)
                ->getAll();
        } else if ($category) {
            return $query->where('categories.id', '=', $category)
                ->getAll();
        } else {
            return $query->getAll();
        }
    }

    public static function update(int $id, string $name, int $category, string $summary)
    {
        $update = new Update('problems');

        return $update->fields([
            'name',
            'category_id',
            'summary'
        ])->where('id', '=', $id)->update([
            $name,
            $category,
            $summary,
            $id
        ]);
    }

    public static function delete(int $id)
    {
        $delete = new Delete('problems');
        return $delete->where('id', '=', $id)->delete();
    }

    function create($session, $name, $category, $summary)
    {
        $create = new Create('problems');

        return $create->values([
            'created_by' => $session,
            'name' => $name,
            'category_id' => $category,
            'summary' => $summary
        ])->insert();
    }
}

