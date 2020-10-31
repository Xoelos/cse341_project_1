<?php

class ErrorView
{
    static function renderBody()
    {
        return '<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-center mt-5">500 Error, please ensure database connection!</h1>
                        </div>
                    </div>
                </div>';
    }

    static function getMeta()
    {
        return 'Error 500';
    }
}