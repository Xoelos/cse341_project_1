<?php

// Database Connections
function dbConnect()
{
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', 'localhost'))) {
        $server = "localhost";
        $port = 5432;
        $database = "ideaio";
        $user = "postgres";
        $password = "password";
        $dsn = 'pgsql:host=' . $server . ';port=' . $port . ';dbname=' . $database . ';user=' . $user . ';password=' . $password;

        try {
            $dbLink = new PDO($dsn);
            return $dbLink;
        } catch (PDOException $exc) {
            include '../views/page.php';
            require '../views/500.php';
            $search = new Page(get500(), render500());
            echo $search->page;
            exit;
        }
    } else {
        $url = getenv('DATABASE_URL');

        try {
            $dbLink = new PDO($url);
            // set the PDO error mode to exception
            $dbLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbLink;
        } catch (PDOException $exc) {
            include '../views/page.php';
            require '../views/500.php';
            $search = new Page(get500(), render500());
            echo $search->page;
            exit;
        }
    }
}

dbConnect();