<?php


class NotFoundView
{

    static function renderBody()
    {
        return '<div class="container-fluid text-center">
                    <div class="row">
                        <div class="col-12">
                            <h1 class="text-center mt-5">404, could not find what you were looking for!</h1>
                        </div>
                    </div>
                </div>';
    }

    static function getMeta()
    {
        return 'Error 404';
    }
}