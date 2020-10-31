<?php

class Vote
{
    private ?bool $vote;
    private ?int $voter;
    private ?bool $problem;
    private ?int $post_id;

    public function __construct($vote = null, $voter = null, $problem = null, $post_id = null)
    {
        $this->vote = $vote;
        $this->voter = $voter;
        $this->problem = $problem;
        $this->post_id = $post_id;
    }

    public static function queryProblemUpvotes()
    {
        $query = new Query('votes');
        $query->fields(['problem_id', 'COUNT(upvote)'])
            ->where('upvote', '=', '1')
            ->statement(' AND problem_id IS NOT NULL ')
            ->groupBy(['problem_id'])
            ->getAll();
    }

    public static function queryProblemDownvotes()
    {
        $query = new Query('votes');
        $query->fields(['problem_id', 'COUNT(upvote)'])
            ->where('upvote', '=', '0')
            ->statement(' AND problem_id IS NOT NULL ')
            ->groupBy(['problem_id'])
            ->getAll();
    }

    public static function upvoteProblem(int $upvote, $problem_id, $session)
    {
        $query = new Query('votes');
        $vote = $query->fields(["*"])->where('voter_id', '=', $session)->statement('AND problem_id = ?')->pushToParams([$problem_id], [false])->get();

        if (!$vote) {
            $create = new Create('votes');
            return $create->values([
                'upvote' => $upvote,
                'voter_id' => $session,
                'problem_id' => $problem_id
            ])->insert();
        } else if ($vote['upvote'] === $upvote) {
            $delete = new Delete('votes');
            return $delete->where('problem_id', '=', $problem_id)
                ->statement('AND voter_id = ?')
                ->pushToParams([$session], [false])
                ->delete();
        } else {
            $update = new Update('votes');
            return $update->fields(['upvote'])
                ->where('problem_id', '=', $problem_id)
                ->statement('AND voter_id = ?')
                ->pushToParams([$session], [false])
                ->update([$upvote, $problem_id, $session]);
        }

    }
}
