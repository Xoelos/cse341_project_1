<?php

function renderBody($search)
{
    return '<div class="container-fluid">
                <div class="row">
                    <div class="col-12">' . $search . '</div>
                </div>
            </div>';
}

function getMeta()
{
    return 'Project 1 | Questions';
}