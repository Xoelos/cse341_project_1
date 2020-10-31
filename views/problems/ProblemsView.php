<?php


class ProblemsView extends View
{
    public static function renderBody($results = [], $session = null, $success = null, $error = null)
    {
        $body = '<div class="jumbotron text-center">
                <h1>Current problems</h1>
             </div>
             <div class="container-fluid">';

        if ($session) {
            $body .= '<div class="row">
                        <div class="col-12 text-center">
                           <div class="d-flex">
                              <a href="/problems/index.php?action=create" class="mx-3"><button type="button" class="btn btn-info mx-auto">Create a new post</button></a>
                              <a href="/account/index.php?action=problems" class="mx-3"><button type="button" class="btn btn-dark mx-auto">See your posts</button></a>
                           </div>
                        </div>
                    </div>';
        }

        $body .= parent::successAlert($success);
        $body .= parent::errorAlert($error);
        $body .= self::renderProblems($results, $session);
        $body .= '</div>';

        return $body;
    }

    private static function renderProblems($results, $session)
    {
        $body = '';

        if ($results && count($results) > 0) {
            foreach ($results as $result) {
                $body .= '<div class="col-12 my-3">
                    <h3>' . $result['name'] . '</h3>
                    <h5>' . $result['category'] . '</h5>
                    <p>' . $result['summary'] . '</p>';

                    $body .= $result['created_by'] == $session
                        ? '<button type="button" class="btn btn-link"><i class="fa fa-thumbs-o-up" style="font-size:24px"></i></button>'
                        : '<button type="button" class="btn btn-link"><i class="fa fa-thumbs-up" style="font-size:24px"></i></button>';


                    $body .= $result['created_by'] == $session
                        ? '<button type="button" class="btn btn-link"><i class="fa fa-thumbs-o-down" style="font-size:24px"></i></button>'
                        : '<button type="button" class="btn btn-link"><i class="fa fa-thumbs-down" style="font-size:24px"></i></button>';

                $body .= '</div>';
            }
        } else {
            $body .= '<div class="col-12 mt-4 text-center">
                        <h2>No results found!</h2>
                      </div>';
        }

        return $body;
    }

    public static function getMeta()
    {
        return 'Project 1 | Questions';
    }
}