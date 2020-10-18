<?php

if (session_id() == "")
    session_start();

include './views/page.php';
require './views/search.php';

$search = new Page(getMeta(), renderBody());


if(isset($_GET['404'])) {
    require './views/404.php';
    $search = new Page(get404(), render404());
}

if(isset($_GET['500'])) {
    require './views/500.php';
    $search = new Page(get500(), render500());
}

echo $search->page;