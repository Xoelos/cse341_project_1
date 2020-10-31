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
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $exc) {
            echo Page::render(ErrorView::getMeta(), ErrorView::renderBody());
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
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        } catch (PDOException $exc) {
            echo Page::render(ErrorView::getMeta(), ErrorView::renderBody());
            exit;
        }
    }
}

dbConnect();
