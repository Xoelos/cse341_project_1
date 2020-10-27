<?php

function renderBody($categories, $posts, $success = false)
{
    if(!$posts) {
        $body = "<div class='container-fluid text-center'>
                    <div class='row mt-5'>
                        <div class='col-12'>
                            <h1>No posts to show!</h1>
                        </div>
                    </div>
                </div>";

        return $body;
    }

    $body = "<div class='container-fluid text-center'>
                <div class='row mt-5'>
                    <div class='col-12'>
                        <h1>Your Posts</h1>
                    </div>
                </div>";

    if ($success) {
        $body .=  "<div class='row'>
                    <div class='col-8 col-md-4 col-lg-3 mx-auto'>
                        <div class='alert alert-success' role='alert'>
                         Post Updated!
                        </div>
                    </div>
                  </div>";
    }

    $body .=  "<div class='row'>
                    <div class='col-12 offset-md-3 col-md-6' >";

    foreach ($posts as $index => $post) {
        $index++;

        $body .= "<form id='createProblem' class='mt-5' method='POST' action='/problems/index.php'>
                      <h2 class='text-left'>Post #$index</h2>
                      <input id='action' type='hidden' name='action' value='updateProblem'>
                      <input id='problemId' type='hidden' name='problemId' value='$post[id]'>
                      <div class='row form-group mt-5'>
                          <div class='col-12 col-md-9'>
                              <label for='Title'>Title</label>
                              <input type='text' class='form-control' id='title' name='name' value='$post[name]' required>
                          </div>
                          <div class='col-12 col-md-3'>
                              <label for='subject'>Subject</label>
                              <select  id='subject' class='custom-select' name='subject'>";

        foreach ($categories as $index => $category) {
            if ($category['id'] === $post['subject_id']){
                $body .= "<option selected='true' value='$category[id]'>$category[name]</option>";
            }  else {
                $body .= "<option value='$category[id]'>$category[name]</option>";
            }
        }

        $body .= "</select>
                              </div>
                          </div>
                          <div class='row form-group'>
                              <div class='col-12'>
                                <label for='summary'>Summary</label>
                                <textarea class='form-control' id='summary' name='summary' rows='5' required>$post[summary]</textarea>
                              </div>
                          </div>
                          <button type='submit' class='btn btn-secondary px-5 mt-4'>Update Thread</button>
                        </form>
                        <form id='deleteProblem' class='mb-5' method='POST' action='/problems/index.php'>
                            <input id='action' type='hidden' name='action' value='deleteProblem'>
                            <input id='problemId' type='hidden' name='problemId' value='$post[id]'>
                            <button type='submit' class='btn btn-danger px-5 mt-4'>Delete Thread</button>
                        </form>";

    }
        $body .= "</div>
                </div>
               </div>";

    return $body;
}

function getMeta()
{
    return 'Project 1 | User Problems';
}