<?php

include_once './library/classes.php';

if (session_id() == "")
    session_start();

// Grab action
$action = null;
if (filter_input(INPUT_POST, 'action') !== null)
    $action = filter_input(INPUT_POST, 'action');

if (filter_input(INPUT_GET, 'action') !== null)
    $action = filter_input(INPUT_GET, 'action');


switch ($action) {

// Show About page
    case 'about':
        include './views/about.php';
        $about = new Page(getMeta(), renderBody());

        echo $about->page;
        break;

    // Show About page
    case 'logout':
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();
        $logout = true;

        require './views/search.php';

        $search = new Page(getMeta(), renderBody($categories, $logout));

        echo $search->page;
        break;

    // Generic Error Page
    case 'error':
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();
        $error = true;

        require './views/search.php';

        $search = new Page(getMeta(), renderBody($categories, false, $error));

        echo $search->page;
        break;

// Show default search page
    default:
        $categoryQuery = new Query('subjects');
        $categories = $categoryQuery->queryAll();

        require './views/search.php';

        $search = new Page(getMeta(), renderBody($categories));

        echo $search->page;
        break;
}