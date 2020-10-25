<?php

function renderBody($categories, $logout = null, $error = null)
{
    $body = '<div class="container-fluid text-center">
                <div class="row mt-5">
                    <div class="col-12 offset-md-4 col-md-4" >
                        <h3 class="mt-5 mb-3">Search for current problems</h3>
                        <form id="search" method="GET" action="problems/index.php">
                             <input id="action" type="hidden" name="action" value="search">
                             <input id="searchTerm" type="text" class="form-control my-3" name="query" placeholder="Search by keyword">
                             <select  id="searchTerm" class="custom-select my-3" name="category">
                             <option selected="true" disabled="disabled">Search by Category</option>';
    foreach ($categories as $index => $category) {
        $body .= "<option value='$category[name]'>$category[name]</option>";
    }

    $body .= '</select>
                            <button type="submit" class="mt-5 btn btn-lg btn-warning">Search</button>
                        </form>
                    </div>
                </div>';

    if ($logout) {
        $body .= '<div class="row mt-5">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="alert alert-success" role="alert">
                         You have successfully logged out!
                        </div>
                    </div>
                  </div>';
    }
    if ($error) {
        $body .= '<div class="row mt-5">
                    <div class="col-12 col-md-4 offset-md-4">
                        <div class="alert alert-danger" role="alert">
                            There has been an error!
                        </div>
                    </div>
                  </div>';
    }

    $body .= '</div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Search';
}