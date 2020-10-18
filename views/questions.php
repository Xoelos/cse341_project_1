<?php

function renderBody($results)
{
    $body = '<div class="jumbotron text-center">
                <h1>Current problems</h1>
             </div>
             <div class="container-fluid">
                <div class="row mt-5">';

    foreach ($results as $result)
    $body .= '<div class="col-12 my-3">
                <h3>' . $result['name'] . '</h3>
                <h5>' . $result['subject'] .'</h5>
                <p>' . $result['summary'] .'</p>
              </div>';


    $body .= '</div></div>';

    return $body;
}

function getMeta()
{
    return 'Project 1 | Questions';
}