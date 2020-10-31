<?php

class SearchView extends View
{
    public static function renderBody($categories, $success = null, $error = null)
    {
        $body = '<div class="container-fluid text-center">
                <div class="row mt-5">
                    <div class="col-12 offset-md-4 col-md-4" >
                        <h3 class="mt-5 mb-3">Search for current problems</h3>
                        <form id="search" method="GET" action="problems/index.php">
                             <input id="action" type="hidden" name="action" value="search">
                             <input id="searchTerm" type="text" class="form-control my-3" name="query" placeholder="Search by Keyword">
                             <select  id="searchTerm" class="custom-select my-3" name="category">
                             <option selected disabled="disabled">Search by Category</option>';
        foreach ($categories as $index => $category) {
            $body .= "<option value='$category[id]'>$category[name]</option>";
        }

        $body .= '</select>
                            <button type="submit" class="mt-5 btn btn-lg btn-warning">Search</button>
                        </form>
                    </div>
                </div>';

        $body .= parent::successAlert($success);
        $body .= parent::errorAlert($error);
        $body .= '</div>';

        return $body;
    }

    public static function getMeta()
    {
        return 'Project 1 | Search';
    }
}