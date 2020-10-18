<?php

echo $_SERVER['REMOTE_ADDR'];

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
        $url = getenv('JAWSDB_URL');
        $dbparts = parse_url($url);

        $hostname = $dbparts['host'];
        $username = $dbparts['user'];
        $password = $dbparts['pass'];
        $database = ltrim($dbparts['path'], '/');

        try {
            $acmeLink = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
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