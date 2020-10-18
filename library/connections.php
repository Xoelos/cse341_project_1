<?php

// Database Connections
function acmeConnect()
{
    if (in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1', 'localhost'))) {
        $server = "localhost";
        $database = "ideaio";
        $user = "postgres";
        $password = "password";
        $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $acmeLink = new PDO($dsn, $user, $password, $options);
            return $acmeLink;
        } catch (PDOException $exc) {
            header('location: ../views/500.php');
            exit;
        }
    } else {
        $url = getenv('DATABASE_URL');

        try {
            $acmeLink = new PDO($url);
            // set the PDO error mode to exception
            $acmeLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $acmeLink;
        } catch (PDOException $exc) {
            header('location: ../views/500.php');
            exit;
        }
    }
}

acmeConnect();