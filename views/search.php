<?php

function renderBody()
{
    return '<div class="container-fluid text-center">
    <div class="row mt-5">
        <div class="col-12 offset-md-4 col-md-4" >
            <h3 class="mt-5 mb-3">Find a product!</h3>
            <form id="search" method="GET" action="posts/index.php" >
                 <input id="searchTerm" type="text" class="form-control" name="search">
                <button type="submit" class="mt-5 btn btn-lg btn-warning">Search</button>
            </form>
        </div>
    </div>
</div>';
}

function getMeta()
{
    return 'Project 1 | Search';
}