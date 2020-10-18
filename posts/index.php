<?php

include '../library/connections.php';

if (session_id() == "")
    session_start();

if (isset($_GET['search']))
    $search = $_GET['search'];

include '../views/page.php';
include '../views/questions.php';
$question = new Page(getMeta(), renderBody($search));

echo $question->page;