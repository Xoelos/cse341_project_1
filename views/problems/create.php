<?php

function renderBody($categories)
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
                                  <label for="category">Category</label>
                                  <select  id="category" class="custom-select" name="category">
                                  <option selected="true" disabled="disabled">Category</option>';
                                 foreach ($categories as $index => $category) {
                                     $body .= "<option value='$category[name]'>$category[name]</option>";
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
                </div>
             </div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Register';
}