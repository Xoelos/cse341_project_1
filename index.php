<?php

if (session_id() == "")
    session_start();

include './views/page.php';
require './views/search.php';

$search = new Page(getMeta(), renderBody());

echo $search->page;