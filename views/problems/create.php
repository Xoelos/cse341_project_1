<?php

function renderBody($categories, $success = false)
{
    $body = '<div class="container-fluid text-center">
                <div class="row mt-5">
                    <div class="col-12 offset-md-3 col-md-6" >
                        <form id="createProblem" method="POST" action="/problems/index.php">
                          <h2>Create a new thread in Problems</h2>
                          <input id="action" type="hidden" name="action" value="createProblem">
                          <div class="row form-group mt-5">
                              <div class="col-12 col-md-9">
                                  <label for="Title">Title</label>
                                  <input type="text" class="form-control" id="title" name="name" required>
                              </div>
                              <div class="col-12 col-md-3">
                                  <label for="subject">Subject</label>
                                  <select  id="subject" class="custom-select" name="subject">
                                  <option selected="true" disabled="disabled">Subject</option>';
                                 foreach ($categories as $index => $category) {
                                     $body .= "<option value='$category[id]'>$category[name]</option>";
                                 }

                            $body .= '</select>
                              </div>
                          </div>
                          <div class="row form-group">
                              <div class="col-12">
                                <label for="summary">Summary</label>
                                <textarea class="form-control" id="summary" name="summary" rows="5" required></textarea>
                              </div>
                          </div>
                          <button type="submit" class="btn btn-secondary px-5 mt-4">Create Thread</button>
                        </form>
                    </div>
                </div>';

    if ($success) {
        $body .= '<div class="row mt-5">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="alert alert-success" role="alert">
                            Your Problem has successfully been added!
                        </div>
                    </div>
                  </div>';
    }

        $body .= '</div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Register';
}