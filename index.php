<?php

include './library/connections.php';
include './library/Query.php';

if (session_id() == "")
    session_start();

if (isset($_GET['about']))
{
    include './views/Page.php';
    include './views/about.php';
    $about = new Page(getMeta(), renderBody());

    echo $about->page;
    exit;
}

$categoryQuery = new Query('problems', 'subject');
$categories = $categoryQuery->queryAll();

include './views/Page.php';
require './views/search.php';

$search = new Page(getMeta(), renderBody($categories));

echo $search->page;
exit;