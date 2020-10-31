<?php

function startSession()
{
    // Start Session if not started
    if (session_id() == "")
        session_start();
}

function grabSession()
{
    // Grab Session
    return isset($_SESSION['logged']) && $_SESSION['logged'] !== null
        ? $_SESSION['logged']
        : null;
}

function grabAction()
{
    // Grab Action
    return isset($_POST['action'])
        ? filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING)
        : filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

function grabError()
{
    // Grab Error
    return isset($_SESSION['error']) && $_SESSION['error'] !== null
        ? $_SESSION['error']
        : null;
}

function grabSuccess()
{
    // Grab Success
    return isset($_SESSION['success']) && $_SESSION['success'] !== null
        ? $_SESSION['success']
        : null;
}

function setError($error)
{
    if ($error)
        $_SESSION['error'] = $error;
    else
        $_SESSION['error'] = null;
}

function setSuccess($success)
{
    if ($success)
        $_SESSION['success'] = $success;
    else
        $_SESSION['success'] = null;
}
