<?php

function renderBody($results)
{
    $body = '<div class="jumbotron text-center">
                <h1>Current problems</h1>
             </div>
             <div class="container-fluid">';

    if($_SESSION['logged']) {
        $body .= '<div class="row">
                    <div class="col-12 text-center">
                       <div class="d-flex">
                          <a href="/problems/index.php?action=create" class="mx-3"><button type="button" class="btn btn-info mx-auto">Create a new post</button></a>
                          <a href="/account/index.php?action=problems" class="mx-3"><button type="button" class="btn btn-dark mx-auto">See your posts</button></a>
                       </div>
                    </div>
                </div>';
    }

    $body .= '<div class="row mt-5">';

        if($results) {
            foreach ($results as $result)
                $body .= '<div class="col-12 my-3">
                    <h3>' . $result['name'] . '</h3>
                    <h5>' . $result['subject'] .'</h5>
                    <p>' . $result['summary'] .'</p>
                  </div>';
        } else {
            $body .= '<div class="col-12 mt-4 text-center">
                        <h2>No results found!</h2>
                      </div>';
        }

    $body .= '    </div>
              </div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Questions';
}