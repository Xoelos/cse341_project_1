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

    public static function queryProblems($session, $name = null, $category = null)
    {
        $query = new Query('problems');

        $query->fields([
            'problems.id',
            'problems.created_by',
            'problems.name',
            'problems.summary',
            'categories.name AS category',
            '(SELECT COUNT(v.voter_id) FROM votes v WHERE v.upvote = 1 AND v.problem_id = problems.id GROUP BY v.problem_id) AS total_upvotes',
            '(SELECT COUNT(v.voter_id) FROM votes v WHERE v.upvote = 0 AND v.problem_id = problems.id GROUP BY v.problem_id) AS total_downvotes',
            '(SELECT v.upvote FROM votes v JOIN problems p2 ON v.problem_id = p2.id WHERE v.voter_id = ? AND v.problem_id = problems.id LIMIT 1) AS upvote',
        ])->join('categories', 'id', 'category_id')
            ->pushToParams([$session], [false]);

        if ($name && $category) {
            $query->statement(" WHERE (LOWER(problems.name) LIKE LOWER(?) ")
                ->statement("OR LOWER(problems.summary) LIKE LOWER(?)) ")
                ->statement("AND categories.id = ? ")
                ->pushToParams([$name, $name, $category], [true, true, false]);
        } else if ($name) {
            $query->statement(' WHERE (LOWER(problems.name) LIKE LOWER(?) OR LOWER(problems.summary) LIKE LOWER(?)) ')
                ->pushToParams([$name, $name], [true, true]);
        } else if ($category) {
             $query->where('problems.category_id', '=', $category);
        }

        return $query->groupBy(['problems.id', 'categories.id'])
        ->orderBy('total_upvotes', false)
        ->statement('NULLS LAST, total_downvotes ASC NULLS LAST, problems.name ASC')
        ->getAll();

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

