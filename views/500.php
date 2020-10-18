<?php

function render500()
{
    return '<div class="container-fluid text-center">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center mt-5">500 Error, please ensure database connection!</h1>
        </div>
    </div>
</div>';
}

function get500()
{
    return 'Error 500';
}