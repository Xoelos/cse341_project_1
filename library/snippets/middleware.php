<?php

function middleware(bool $authed, ?int $session)
{
    if ($authed && !$session)
    {
        setSuccess('Please log in or register to use this feature!');
        setError(null);
         header('Location: /account/index.php?action=login');
         exit;
     }

    if (!$authed && $session)
    {
        setSuccess(null);
        setError(null);
        header('Location: /account/index.php');
        exit;
    }
}