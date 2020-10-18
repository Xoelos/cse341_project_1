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
            include '../views/Page.php';
            require '../views/500.php';
            $search = new Page(get500(), render500());
            echo $search->page;
            exit;
        }
    } else {
        $url = parse_url(getenv("DATABASE_URL"));

        $host = $url["host"];
        $username = $url["user"];
        $password = $url["pass"];
        $database = substr($url["path"], 1);
        $dsn = 'pgsql:host=' . $host . ';dbname=' . $database . ';user=' . $username . ';password=' . $password;

        try {
            $dbLink = new PDO($dsn);
            return $dbLink;
        } catch (PDOException $exc) {
            include '../views/Page.php';
            require '../views/500.php';
            $search = new Page(get500(), render500());
            echo $search->page;
            exit;
        }
    }
}

dbConnect();