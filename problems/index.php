<?php

include '../library/connections.php';
include '../library/Query.php';

if (session_id() == "")
    session_start();

$results = null;

if (!isset($_GET['search']) && !isset($_GET['category'])) {
    $problemsQuery = new Query('problems');
    $results = $problemsQuery->queryAll();
} else if (!isset($_GET['category'])) {
    if ($_GET['search'] !== '') {
        $search = $_GET['search'];
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryByColumns($search, array('name', 'summary'));

    } else {
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryAll();

    }
} else {
    if ($_GET['search'] !== '' && $_GET['category'] !== '') {
        $search = $_GET['search'];
        $category = $_GET['category'];
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryByColumnsWithValues($search, array('name', 'summary'), $category, 'subject');

    } else if ($_GET['search'] !== '') {
        $search = $_GET['search'];
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryByColumns($search, array('name', 'summary'));

    } else if ($_GET['category'] !== '') {
        $category = $_GET['category'];
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryByColumns($category, array('name', 'summary'));

    } else {
        $problemsQuery = new Query('problems');
        $results = $problemsQuery->queryAll();

    }
}


include '../views/Page.php';
include '../views/questions.php';
$question = new Page(getMeta(), renderBody($results));

echo $question->page;

